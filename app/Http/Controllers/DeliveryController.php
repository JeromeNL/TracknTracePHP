<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportedDeliveriesRequest;
use App\Models\Delivery;
use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use App\Models\enums\DeliveryStatus;
use App\Services\ImportDeliveryService;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DeliveryController extends Controller
{
    private ImportDeliveryService $importService;

    public function __construct(ImportDeliveryService $importService)
    {
        $this->importService = $importService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::getDeliveriesUserCanAccess(auth()->user());
        return view('deliveries.index', compact('deliveries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryRequest $request)
    {
        $row['expected_delivery_datetime'] = $request->expected_delivery_datetime;
        $row['description'] = $request->description;
        $row['weight'] = $request->weight;
        $row['customer_firstname'] = $request->customer_firstname;
        $row['customer_lastname'] = $request->customer_lastname;
        $row['customer_email'] = $request->customer_email;
        $row['customer_phone'] = $request->customer_phone;
        $row['customer_street'] = $request->customer_street;
        $row['customer_housenumber'] = $request->customer_housenumber;
        $row['customer_city'] = $request->customer_city;
        $row['customer_postalcode'] = $request->customer_postalcode;
        $row['customer_country'] = $request->customer_country;
        $row['delivery_company'] = $request->delivery_company;

        $delivery = $this->importService->createDeliveryFromRowData($row);

         return [
             'track_and_trace_code' => $delivery->track_and_trace_code,
             'expected_delivery_date' => $delivery->expected_delivery_date,
         ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        $delivery = Delivery::find($delivery->id);
        $package = $delivery->package;
        $customer = $package->customer;
        $webshop = $package->webshop;
        $deliveryCosts = $package->CalculateDeliveryCost();
        $canPrintLabel = $delivery->delivery_status == DeliveryStatus::Aangemeld;
        $review = $delivery->review;

        return view('deliveries.show', compact('delivery', 'package', 'customer', 'webshop', 'deliveryCosts', 'canPrintLabel', 'review'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(UpdateDeliveryRequest $request)
    {
        $delivery = Delivery::where('track_and_trace_code', $request->track_and_trace_code)->first();
        $oldStatus = $delivery->delivery_status;
        $delivery->changeStatus(constant('App\Models\enums\DeliveryStatus::' . $request->delivery_status));

        return [
            'TrackAndTraceCode' => $request->track_and_trace_code,
            'old status' => $oldStatus,
            'new Status' => $delivery->delivery_status,
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return redirect()->route('deliveries.index');
    }

    public function Search(Request $request): View|Application|Factory
    {
        $search = $request->search;
        $deliveries = Delivery::search($search)->paginate(15);

        return view('deliveries.index', compact('deliveries'));
    }

    public function PrintDeliveryLabel(Request $request, Delivery $delivery): Response
    {
        $delivery = Delivery::find($delivery->id);
        $postalService = $request->postalservice;
        $delivery->changeStatus(DeliveryStatus::Uitgeprint);
        $delivery->changePostalService(constant('App\Models\enums\CompanyNames::' . $postalService));

        $deliveries = [$delivery];
        $pdf = PDF::loadView('pdf.deliverylabel', compact('deliveries', 'postalService'));
        return $pdf->stream();
    }

    public function Import(): View|Application|Factory
    {
        return view('deliveries.import');
    }

    public function DownloadExamplefile(): BinaryFileResponse
    {
        $filePath = $this->importService->getExampleImportFileStoragePath();
        return response()->download($filePath);
    }

    public function SaveImportedDeliveries(ImportedDeliveriesRequest $request): RedirectResponse
    {
        $file = $request->file('file');
        $file->storeAs('imported-deliveries', $file->getClientOriginalName());
        $filePath = storage_path('app/imported-deliveries/' . $file->getClientOriginalName());
        $rows = SimpleExcelReader::create($filePath)->getRows();
        $validFile = $this->importService->validateFile($rows);

        if (!$validFile) {
            flash('Het bestand is niet geldig.');
            return redirect()->route('deliveries.import');
        }

        $rows = SimpleExcelReader::create($filePath)->getRows();

        DB::beginTransaction();

        try {
            $rows->each(function (array $row) {
                $this->importService->CreateDeliveryFromRowData($row);
            });
            DB::commit();
        } catch (Exception) {
            DB::rollBack();
            flash('Er is iets fout gegaan bij het importeren van de leveringen.');
            return redirect()->route('deliveries.import');
        }

        return redirect()->route('deliveries.index');
    }

    public function PrintLabels(Request $request)
    {
        $deliveries = [];
        foreach (Delivery::all() as $delivery) {
            if ($request[$delivery->id] == 'on') {
                $deliveries[] = $delivery;
                $delivery->changeStatus(DeliveryStatus::Uitgeprint);
            }
        }
        $postalService = $request['postalService'];
        $pdf = PDF::loadView('pdf.deliverylabel', compact('deliveries', 'postalService'));

        return $pdf->stream();
    }

}
