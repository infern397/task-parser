<?php

namespace App\Console\Commands;

use App\Models\Companies\Account;
use App\Models\Companies\ApiService;
use App\Services\FetchApiService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Command;

abstract class FetchDataCommand extends Command
{
    protected function fetchDataAndSave(FetchApiService $apiService, string $endpoint, string $dateFrom, string $dateTo, int $limit, Model $model, int $userId)
    {
        $model::query()->where('account_id', $userId)->delete();
        $page = 1;
        $insertThreshold = 10000;

        do {
            try {
                $data = $apiService->fetchData($endpoint, $dateFrom, $dateTo, $page, $limit);
            } catch (ClientException $e) {
                $statusCode = $e->getResponse()->getStatusCode();
                if ($statusCode == 429) {
                    $this->info('Rate limit exceeded, sleeping for 45 seconds');
                    sleep(45);
                    continue;
                } elseif ($statusCode == 403) {
                    $this->error('Access forbidden for this account, skipping');
                    break;
                }

                throw $e;
            }

            $allData = [];
            foreach ($data['data'] as $item) {
                $item['account_id'] = $userId; // Add the user ID to each item
                $allData[] = $item;

                if (count($allData) >= $insertThreshold) {
                    $insertionData = collect($allData);
                    $insertionData->chunk(500)->each(function ($chunk) use ($model) {
                        $model::query()->insert($chunk->toArray());
                    });
                    $allData = [];
                }
            }

            if (!empty($allData)) {
                $model::query()->insert($allData);
            }

            $this->info("Fetched {$endpoint} page {$page} with " . count($data['data']) . " records.");
            $page++;
        } while (isset($data['links']['next']));

        $this->info(ucfirst($endpoint) . ' fetched successfully');
    }

    protected function getApiService($apiServiceId)
    {
        return ApiService::find($apiServiceId);
    }
}
