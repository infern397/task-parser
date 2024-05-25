<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://89.108.115.241:6969',
        ]);
    }

    public function fetchData($type, $dateFrom, $dateTo, $page, $key, $limit)
    {
        $response = $this->client->request('GET', "/api/{$type}", [
            'query' => [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page,
                'key' => $key,
                'limit' => $limit
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
