<?php

use aharen\FlightMv\Flight;
use PHPUnit\Framework\TestCase;
use aharen\FlightMv\ApiClient\MockApiClient;

class ArrivalsFlightTest extends TestCase
{
    private $flight;

    public function setUp(): void
    {
        $this->flight = (new Flight(
            new MockApiClient()
        ))->arrivals();
    }
    
    public function test_arrivals_count()
    {
        $this->assertCount(15, $this->flight->toArray());
    }
    
    public function test_arrivals_last_updated()
    {
        $this->assertEquals('20200817 19:45', $this->flight->updated());
    }

    public function test_arrivals_get_first_result()
    {
        $this->assertEquals([
            'AirLineID' => 'Q2',
            'AirLineName' => 'Maldivian',
            'FlightID' => 'Q2 8121',
            'Route1' => 'Fuvahmulah',
            'Route2' => [],
            'Route3' => [],
            'Route4' => [],
            'Route5' => [],
            'Route6' => [],
            'Scheduled' => '19:50',
            'Estimated' => '19:25',
            'Status' => 'LA',
            'Gate' => [],
            'Terminal' => [],
            'CheckinArea' => [],
            'Date' => '20200817',
            'PrimaryFlight' => [],
            'CarrierType' => 'D',
        ], $this->flight->get()->first());
    }

    public function test__arrivals_where_filter_get()
    {
        $this->assertCount(3, $this->flight->where('AirLineID', 'Q2')->get());
    }

    public function test__arrivals_where_filter_array()
    {
        $this->assertCount(3, $this->flight->where('AirLineID', 'Q2')->toArray());
    }
}
