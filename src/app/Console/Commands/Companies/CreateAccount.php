<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\Account;
use Illuminate\Console\Command;

class CreateAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:account {name} {company_id}';

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
        $account = new Account();
        $account->name = $this->argument('name');
        $account->company_id = $this->argument('company_id');
        $account->save();

        $this->info('Account created successfully.');

        return 0;
    }
}
