<?php

namespace App\Console\Commands;

use App\Models\Stock;
use App\Services\ApiService;
use Illuminate\Console\Command;

class FetchStocks extends FetchDataCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:stocks {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch stocks from the API';
    /**
     * @var ApiService
     */
    private $apiService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ApiService $apiService)
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
        $userId = $this->argument('userId');
        $account = $this->getAccount($userId);

        if (!$account) {
            $this->error('Account not found');
            return 0;
        }

        $apiKey = $account->getValidToken();
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
            $userId
        );
    }
}
