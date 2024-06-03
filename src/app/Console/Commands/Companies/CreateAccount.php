<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\Account;
use App\Models\Companies\ApiService;
use App\Models\Companies\Company;

use Illuminate\Console\Command;

class CreateAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:account {companyId} {apiServiceId} {username} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new account';

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
    public function handle()
    {
        $companyId = $this->argument('companyId');
        $apiServiceId = $this->argument('apiServiceId');
        $username = $this->argument('username');
        $password = $this->argument('password');

        $company = Company::find($companyId);
        $apiService = ApiService::find($apiServiceId);

        if (!$company || !$apiService) {
            $this->error("Company or API service not found.");
            return 0;
        }

        $account = Account::create([
            'company_id' => $companyId,
            'api_service_id' => $apiServiceId,
            'username' => $username,
            'password' => bcrypt($password)
        ]);

        $this->info("Account '{$account->username}' created successfully for company '{$company->name}' and API service '{$apiService->name}' with ID {$account->id}");
        return 0;
    }
}
