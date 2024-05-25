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
    protected $signature = 'fetch:stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch stocks from the API';

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
            'stocks',
            date('Y-m-d'),
            '9999-12-31',
            env('API_KEY'),
            500,
            new Stock
        );
    }
}
