<?php

namespace App\Console\Commands;

use App\Models\Companies\ApiService;
use Illuminate\Console\Command;
use App\Models\Companies\Account;

class FetchAllData extends Command
{
    protected $signature = 'fetch:all {apiServiceId?} {date?}';
    protected $description = 'Fetch all data from API for all users or specific user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dateFrom = $this->argument('date');

        $apiServiceId = (int)$this->argument('apiServiceId');
        $apiServicesQuery = ApiService::query();

        if ($apiServiceId) {
            $apiServicesQuery->where('id', $apiServiceId);
        }

        $apiServices = $apiServicesQuery->get();

        foreach ($apiServices as $apiService) {
            $this->info("Fetching for service {$apiService['name']} starting");
            $this->call('fetch:stocks', ['apiServiceId' => $apiService->id]);
            $this->call('fetch:incomes', ['apiServiceId' => $apiService->id, 'date' => $dateFrom]);
            $this->call('fetch:sales', ['apiServiceId' => $apiService->id, 'date' => $dateFrom]);
            $this->call('fetch:orders', ['apiServiceId' => $apiService->id, 'date' => $dateFrom]);
        }

        $this->info('All data fetched successfully');
    }
}
