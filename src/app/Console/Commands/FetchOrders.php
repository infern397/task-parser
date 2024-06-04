<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Sale;
use App\Models\Stock;
use App\Services\ApiService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class FetchOrders extends FetchDataCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:orders {userId} {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch orders from the API';
    /**
     * @var array|string
     */
    private $dateFrom;

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
        $dateFrom = $this->argument('date') ?? '1000-01-01';
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
        $this->info("Orders fetching for account {$account['username']} starting");

        $this->fetchDataAndSave(
            $this->apiService,
            'orders',
            $dateFrom,
            '9999-12-31',
            500,
            new Order,
            $userId
        );
    }
}
