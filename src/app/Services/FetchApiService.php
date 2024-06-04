<?php

namespace App\Services;

use GuzzleHttp\Client;

class FetchApiService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://89.108.115.241:6969',
        ]);
    }

    public function setApiKey($key)
    {
        $this->apiKey = $key;
    }

    public function fetchData($type, $dateFrom, $dateTo, $page, $limit)
    {
        $response = $this->client->request('GET', "/api/{$type}", [
            'query' => [
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'page' => $page,
                'key' => $this->apiKey,
                'limit' => $limit
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
