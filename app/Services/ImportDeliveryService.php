<?php

namespace App\Services;

use App\Exceptions\InvalidDataException;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\enums\DeliveryStatus;
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ImportDeliveryService
{
    const DEFAULT_STRING_VALIDATION_RULE = 'required|string';

    public function getExampleImportFileStoragePath(): string
    {
        return storage_path('app/examplefiles/Deliveries.xlsx');
    }

    public function validateFile($rows): bool
    {
        return $this->validateFileHeadings($rows) && $this->validateData($rows);
    }

    private function validateFileHeadings($rows): bool
    {
        $row = $rows->first();
        $correctFileHeadings = ['expected_delivery_datetime', 'description', 'weight', 'customer_firstname', 'customer_lastname', 'customer_email', 'customer_phone', 'customer_street', 'customer_housenumber', 'customer_city', 'customer_postalcode', 'customer_country', 'delivery_company'];
        $rowHeadings = array_keys($row);

        return $rowHeadings === $correctFileHeadings;
    }

    private function validateData($rows): bool
    {
        try {
            $rows->each(function ($row) {
                if (!$this->validateRow($row)) {
                    throw new InvalidDataException('Het bestand is niet geldig.');
                }
            });
        } catch (InvalidDataException) {
            return false;
        }

        return true;
    }

    private function validateRow($row): bool
    {
        $rules = [
            'expected_delivery_datetime' => 'required|date',
            'description' => self::DEFAULT_STRING_VALIDATION_RULE,
            'weight' => 'required|numeric',
            'customer_firstname' => self::DEFAULT_STRING_VALIDATION_RULE,
            'customer_lastname' => self::DEFAULT_STRING_VALIDATION_RULE,
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'customer_street' => self::DEFAULT_STRING_VALIDATION_RULE,
            'customer_housenumber' => ['required', 'regex:/^[0-9]+[a-zA-Z]?$/'],
            'customer_city' => self::DEFAULT_STRING_VALIDATION_RULE,
            'customer_postalcode' => ['required', 'regex:/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i'],
            'customer_country' => self::DEFAULT_STRING_VALIDATION_RULE,
            'delivery_company' => self::DEFAULT_STRING_VALIDATION_RULE,
        ];

        $validator = Validator::make($row, $rules);

        return $validator->passes();
    }

    public function createAddressFromFile(array $row): Address
    {
        $address = new Address();
        $address->street = $row['customer_street'];
        $address->number = $row['customer_housenumber'];
        $address->city = $row['customer_city'];
        $address->postal_code = $row['customer_postalcode'];
        $address->country = $row['customer_country'];
        $address->save();
        return $address;
    }

    private function assignCustomerToPackage(array $row, Package $package): void
    {
        $customerExists = Customer::where('email', $row['customer_email'])->first();

        if ($customerExists != null) {
            $package->customer_id = $customerExists->id;
        } else {
            $customer = new Customer();
            $customer->firstname = $row['customer_firstname'];
            $customer->lastname = $row['customer_lastname'];
            $customer->email = $row['customer_email'];
            $customer->phone = $row['customer_phone'];

            $address = $this->CreateAddressFromFile($row);

            $customer->address_id = $address->id;
            $customer->save();
            $package->customer_id = $customer->id;
        }
    }

    private function createPackage(array $row): Package
    {
        $package = new Package();
        $package->description = $row['description'];
        $package->weight = $row['weight'];
        $package->webshop_id = auth()->user()->webshop->id;
        return $package;
    }

    public function createDeliveryFromRowData(array $row): Delivery
    {
        $delivery = new Delivery();
        $delivery->track_and_trace_code = Str::uuid();
        $delivery->delivery_status = DeliveryStatus::Aangemeld;
        $delivery->expected_delivery_date = $row['expected_delivery_datetime'];
        $delivery->delivery_company = $row['delivery_company'];

        $package = $this->createPackage($row);

        $this->assignCustomerToPackage($row, $package);

        $package->save();

        $delivery->package_id = $package->id;

        $delivery->save();

        return $delivery;
    }

}
