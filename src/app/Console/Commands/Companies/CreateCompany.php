<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\Company;
use Illuminate\Console\Command;

class CreateCompany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:company {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new company';

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
        $company = new Company();
        $company->name = $this->argument('name');
        $company->save();

        $this->info('Company created successfully.');

        return 0;
    }
}
