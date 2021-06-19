<?php

namespace App\Console\Commands;

use App\Lib\BudgetManagement;
use App\Models\Masters\Budget;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BudgetRefresh extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'budget:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshes the budget balance using budget master.';

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
     * @return mixed
     */
    public function handle()
    {

        $proceed = $this->confirm('Are you sure you want to refresh the budget balances ?, this will remove existing data from database.', false);
        
        if ($proceed) {
            DB::table('budget_balances')->truncate();
            DB::table('budget_balance_ledgers')->truncate();

            $budgetMaster = Budget::all();

            $budgetManagement = new BudgetManagement;

            foreach ($budgetMaster as $budget) {
                $budgetManagement->addAmount($budget, $budget->fund_released_amount);
            }
        }
    }
}
