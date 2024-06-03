<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\ApiServices;
use Illuminate\Console\Command;

class CreateApiService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:apiservice {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new API service';

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
        $apiServices = new ApiServices();
        $apiServices->name = $this->argument('name');
        $apiServices->save();

        $this->info('API service created successfully.');

        return 0;
    }
}
