<?php

use aharen\FlightMv\Flight;
use PHPUnit\Framework\TestCase;
use aharen\FlightMv\ApiClient\MockApiClient;

class DeparturesFlightTest extends TestCase
{
    private $flight;

    public function setUp(): void
    {
        $this->flight = (new Flight(
            new MockApiClient()
        ))->departures();
    }

    public function test_departures_count()
    {
        $this->assertCount(7, $this->flight->toArray());
    }
    
    public function test_departures_last_updated()
    {
        $this->assertEquals('20200817 19:38', $this->flight->updated());
    }

    public function test_departures_get_first_result()
    {
        $this->assertEquals([
            'AirLineID' => 'QR',
            'AirLineName' => 'Qatar Air',
            'FlightID' => 'QR 675',
            'Route1' => 'Doha',
            'Route2' => [],
            'Route3' => [],
            'Route4' => [],
            'Route5' => [],
            'Route6' => [],
            'Scheduled' => '20:00',
            'Estimated' => [],
            'Status' => 'FZ',
            'Gate' => [],
            'Terminal' => [],
            'CheckinArea' => [],
            'Date' => '20200817',
            'PrimaryFlight' => [],
            'CarrierType' => 'I',
        ], $this->flight->get()->first());
    }

    public function test__departures_where_filter_get()
    {
        $this->assertCount(2, $this->flight->where('AirLineID', 'QR')->get());
    }

    public function test__departures_where_filter_array()
    {
        $this->assertCount(2, $this->flight->where('AirLineID', 'QR')->toArray());
    }
}
