<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Companies\Account;

class FetchAllData extends Command
{
    protected $signature = 'fetch:all {userId?} {date?}';
    protected $description = 'Fetch all data from API for all users or specific user';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $dateFrom = $this->argument('date');

        $userId = (int) $this->argument('userId');
        $accountsQuery = Account::query();

        if ($userId) {
            $accountsQuery->where('id', $userId);
        }

        $accounts = $accountsQuery->get();
        $this->info($userId);

        foreach ($accounts as $account) {
            $this->call('fetch:stocks', ['userId' => $account->id]);
            $this->call('fetch:incomes', ['userId' => $account->id, 'date' => $dateFrom]);
            $this->call('fetch:sales', ['userId' => $account->id, 'date' => $dateFrom]);
            $this->call('fetch:orders', ['userId' => $account->id, 'date' => $dateFrom]);
        }

        $this->info('All data fetched successfully');
    }
}
