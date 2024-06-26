<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\ApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateApiService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:apiservice {name} {tokenTypeId}';

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
        $tokenTypeId = $this->argument('tokenTypeId');

        $apiService = ApiService::create([
            'name' => $name,
            'token_type_id' => $tokenTypeId,
        ]);

        $this->info("API service '{$apiService->name}' created successfully with ID {$apiService->id}");

        return 0;
    }
}
