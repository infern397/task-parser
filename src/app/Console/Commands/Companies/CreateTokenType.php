<?php

namespace App\Console\Commands\Companies;

use App\Models\Companies\TokenType;
use Illuminate\Console\Command;

class CreateTokenType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:tokentype {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new token type';

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
        $type = $this->argument('type');
        $tokenType = TokenType::create(['type' => $type]);
        $this->info("Token type '{$tokenType->type}' created successfully with ID {$tokenType->id}");
        return 0;
    }
}
