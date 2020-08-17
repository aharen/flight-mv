<?php

namespace aharen\FlightMv\ApiClient;

use aharen\FlightMv\ApiClient\Interfaces\ApiClientInterface;

class MockApiClient implements ApiClientInterface
{
    public function get($path): array
    {
        $data = file_get_contents(__DIR__ . '/../../../tests/data/' . $path);

        $xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);

        $json = json_encode($xml);
        
        return json_decode($json, true);
    }
}
