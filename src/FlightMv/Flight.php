<?php

namespace aharen\FlightMv;

use aharen\FlightMv\ApiClient\Interfaces\ApiClientInterface;
use Illuminate\Support\Collection;

class Flight
{
    private ApiClientInterface $client;

    private Collection $data;

    private string $lastUpdated;

    public function __construct(ApiClientInterface $client)
    {
        $this->client = $client;
    }

    private function apiCall($path): void
    {
        $resp = $this->client->get($path);
        
        $this->lastUpdated = $resp['UpdateTime'];
        
        $this->data = new Collection(
            $resp['Flight']
        );
    }

    public function updated(): string
    {
        return $this->lastUpdated;
    }

    public function arrivals(): Flight
    {
        $this->apiCall('arrive.xml');

        return $this;
    }

    public function departures(): Flight
    {
        $this->apiCall('depart.xml');

        return $this;
    }

    public function get(): Collection
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return $this->data->values()->toArray();
    }

    public function where($field, $value): Flight
    {
        $this->data = $this->data->filter(function ($item) use ($field, $value) {
            return $item[$field] === $value;
        });

        return $this;
    }
}
