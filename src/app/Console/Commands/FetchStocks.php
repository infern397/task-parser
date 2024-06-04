<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Services\FetchApiService;
use Illuminate\Console\Command;

class FetchStocks extends FetchDataCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:stocks {apiServiceId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch stocks from the API {apiServiceId}';
    /**
     * @var FetchApiService
     */
    private $apiService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FetchApiService $apiService)
    {
        parent::__construct();
        $this->apiService = $apiService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $apiServiceId = $this->argument('apiServiceId');
        $apiService = $this->getApiService($apiServiceId);

        if (!$apiService) {
            $this->error('Service not found');
            return 0;
        }
        $this->info("Stocks fetching for service {$apiService['name']} starting");
        $accounts = $apiService->accounts;
        foreach ($accounts as $account) {
            $apiKey = $account->token['token'];
            if (!$apiKey) {
                $this->error('Valid API token not found');
                return 0;
            }

            $this->apiService->setApiKey($apiKey);
            $this->info("Stocks fetching for account {$account['username']} starting");

            $this->fetchDataAndSave(
                $this->apiService,
                'stocks',
                date('Y-m-d'),
                '2024-12-31',
                500,
                new Stock(),
                $account['id']
            );
        }
    }
}
