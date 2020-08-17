<?php

namespace aharen\FlightMv\ApiClient;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use aharen\FlightMv\ApiClient\Interfaces\ApiClientInterface;

class ApiClient implements ApiClientInterface
{
    private const API_BASE = 'http://www.fis.com.mv/xml/';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::API_BASE,
            'headers' => [
                'Accept' => 'text/xml'
            ]
        ]);
    }

    public function get($path): array
    {
        return $this->getResponseBody(
            $this->client->request('GET', $path)
        );
    }

    private function getResponseBody(ResponseInterface $response): array
    {
        $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);

        $json = json_encode($xml);
        
        return json_decode($json, true);
    }
}
