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
    protected $signature = 'fetch:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch orders from the API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ApiService $apiService)
    {
        $this->fetchDataAndSave(
            $apiService,
            'orders',
            '1000-01-01',
            '9999-12-31',
            env('API_KEY'),
            500,
            new Order
        );
    }
}
