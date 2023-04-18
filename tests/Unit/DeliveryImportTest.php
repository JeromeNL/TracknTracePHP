<?php

namespace Tests\Unit;

use App\Services\ImportDeliveryService;
use Illuminate\Support\Collection;
use Tests\TestCase;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Support\Facades\Validator;

class DeliveryImportTest extends TestCase
{
    private ImportDeliveryService $importDeliveryService;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->importDeliveryService = new ImportDeliveryService();
    }

    protected static function getMethod($name): ReflectionMethod
    {
        $class = new ReflectionClass('App\Services\ImportDeliveryService');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }


    public function testValidateCorrectFileHeadings()
    {
        $file = $this->generateCorrectFakeFile();
        $method = self::getMethod('validateFileHeadings');
        $result = $method->invokeArgs($this->importDeliveryService, [$file]);
        $this->assertTrue($result);
    }

    public function testValidateIncorrectFileHeadings()
    {
        $file = $this->generateIncorrectFakeFile();
        $method = self::getMethod('validateFileHeadings');
        $result = $method->invokeArgs($this->importDeliveryService, [$file]);
        $this->assertFalse($result);
    }

    public function testValidateCorrectData()
    {
        $file = $this->generateCorrectFakeFile();
        $method = self::getMethod('validateData');
        $result = $method->invokeArgs($this->importDeliveryService, [$file]);
        $this->assertTrue($result);
    }

    public function testValidateIncorrectData()
    {
        $file = $this->generateIncorrectFakeFile();
        $method = self::getMethod('validateData');
        $result = $method->invokeArgs($this->importDeliveryService, [$file]);
        $this->assertFalse($result);
    }

    private function generateCorrectFakeFile(): Collection
    {
        $fileHeadings = ['expected_delivery_datetime', 'description', 'weight', 'customer_firstname', 'customer_lastname', 'customer_email', 'customer_phone', 'customer_street', 'customer_housenumber', 'customer_city', 'customer_postalcode', 'customer_country', 'delivery_company'];
        $rowOne = ['05-04-2023 12:00', 'Kleding', '1.5', 'Lamine', 'Slot', 'slotlamine@gmail.com', '0612345678', ' Van Hooistraat', '12', 'Amsterdam', '2384 IK', 'Nederland',  'PostNL'];
        $rowTwo = ['07-04-2023 10:30', 'Elektronica', '2.2', 'Alicia', 'Garcia', 'aliciagarcia@gmail.com', '0623456789', 'Kerkstraat', '5A', 'Utrecht', '3500 AB', 'Nederland', 'DHL'];
        $arrayOne = array_combine($fileHeadings, $rowOne);
        $arrayTwo = array_combine($fileHeadings, $rowTwo);
        return collect([$arrayOne, $arrayTwo]);
    }

    private function generateIncorrectFakeFile()
    {
        $fileHeadings = ['expected_delivery_datetime', 'customer_street', 'customer_housenumber', 'customer_city', 'customer_postalcode', 'customer_country', 'delivery_company'];
        $rowOne = ['05-04-2023 12:00', 'Kleding', '1.5', 'Lamine', 'Slot', 'slotlamine@gmail.com', '0612345678'];
        $rowTwo = ['07-04-2023 10:30', 'Elektronica', '2.2', 'Alicia', 'Garcia', 'Nederland', '3500AB'];
        $arrayOne = array_combine($fileHeadings, $rowOne);
        $arrayTwo = array_combine($fileHeadings, $rowTwo);
        return collect([$arrayOne, $arrayTwo]);
    }

}
