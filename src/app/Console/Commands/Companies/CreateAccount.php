<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\Account;
use App\Models\Companies\ApiService;
use App\Models\Companies\Company;

use App\Models\Companies\Token;
use Illuminate\Console\Command;

class CreateAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:account {companyId} {tokenId} {username} {password}';

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
        $tokenId = $this->argument('tokenId');
        $username = $this->argument('username');
        $password = $this->argument('password');

        $company = Company::find($companyId);
        $token = Token::find($tokenId);

        if (!$company || !$token) {
            $this->error("Company or Token not found.");
            return 0;
        }

        $account = Account::create([
            'company_id' => $companyId,
            'token_id' => $tokenId,
            'username' => $username,
            'password' => bcrypt($password)
        ]);

        $this->info("Account '{$account->username}' created successfully for company '{$company->name}' with token ID {$token->id} and account ID {$account->id}");
        return 0;
    }
}
