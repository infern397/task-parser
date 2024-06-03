<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\Account;
use App\Models\Companies\Token;
use App\Models\Companies\TokenType;
use Illuminate\Console\Command;

class CreateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:token {accountId} {tokenTypeId} {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new token';

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
        $accountId = $this->argument('accountId');
        $tokenTypeId = $this->argument('tokenTypeId');
        $token = $this->argument('token');

        $account = Account::find($accountId);
        $tokenType = TokenType::find($tokenTypeId);

        if (!$account || !$tokenType) {
            $this->error("Account or token type not found.");
            return 0;
        }

        $token = Token::create([
            'account_id' => $accountId,
            'token_type_id' => $tokenTypeId,
            'token' => $token
        ]);

        $this->info("Token created successfully for account ID {$account->id} and token type '{$tokenType->type}' with ID {$token->id}");
        return 0;
    }
}
