<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FetchAllData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all data from API';

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
        $this->call('fetch:stocks');
        $this->call('fetch:incomes');
        $this->call('fetch:sales');
        $this->call('fetch:orders');
        $this->info('All data fetched successfully');
    }
}
