<?php

namespace App\Console\Commands;

use App\Models\Income;
use App\Models\Stock;
use App\Services\ApiService;
use Illuminate\Console\Command;

class FetchIncomes extends FetchDataCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:incomes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch incomes from API';

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
            'incomes',
            '1000-01-01',
            '9999-12-31',
            env('API_KEY'),
            500,
            new Income
        );
    }
}
