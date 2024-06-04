<?php

namespace App\Console\Commands;

use App\Models\Income;
use App\Models\Stock;
use App\Services\ApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchIncomes extends FetchDataCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:incomes {userId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch incomes from API {userId}';

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
        $this->info("Incomes fetching for account {$account['username']} starting");
        $this->fetchDataAndSave(
            $this->apiService,
            'incomes',
            '1000-01-01',
            '9999-12-31',
            500,
            new Income,
            $userId
        );
    }
}
