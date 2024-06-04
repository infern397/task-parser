<?php

namespace App\Console\Commands;

use App\Models\Income;
use App\Models\Stock;
use App\Services\FetchApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchIncomes extends FetchDataCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:incomes {apiServiceId} {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch incomes from API {apiServiceId}';
    /**
     * @var array|string
     */

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
        list($dateFrom, $accounts) = $this->prepareFetch();

        foreach ($accounts as $account) {
            $apiKey = $account->token['token'];
            if (!$apiKey) {
                $this->error('Valid API token not found');
                return 0;
            }

            $this->apiService->setApiKey($apiKey);
            $this->info("Incomes fetching for account {$account['username']} starting");
            $this->fetchDataAndSave(
                $this->apiService,
                'incomes',
                $dateFrom,
                '9999-12-31',
                500,
                new Income,
                $account['id']
            );
        }
    }
}
