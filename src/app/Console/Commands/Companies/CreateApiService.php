<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\ApiService;
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
        $name = $this->argument('name');
        $apiService = ApiService::create(['name' => $name]);
        $this->info("API service '{$apiService->name}' created successfully with ID {$apiService->id}");

        return 0;
    }
}
