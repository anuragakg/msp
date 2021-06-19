<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class truncate_data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'truncate_data {user}';{for arguments}
    protected $signature = 'truncate_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'truncate data from tables';

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
    	if (!$this->confirm('Do you wish to continue?', true)) 
    	{
    		return false;
    	}

    	$not_to_be_truncated=[
    		'email_templates',
    		'financial_year_master',
    		'id_proof_master',
    		'levels_master',
    		'migrations',
    		'oauth_access_tokens',
    		'oauth_auth_codes',
    		'oauth_clients',
    		'oauth_personal_access_clients',
    		'oauth_refresh_tokens',
    		'password_resets',
    		'permissions',
    		'refresh_token',
    		'role_permissions_relationship',
    		'states_master',
    		'state_level_fund_flow_relationship',
    		'state_level_role_relationship',
    		'state_role_sublevel',
    		'users',
    		'users_activity',
    		'users_allowed_states',
    		'users_mapping',
    		'user_bank_details',
    		'user_details',
    		'user_mapped_to_haatbazaar',
    		'user_mapped_to_warehouse',
    		'user_password_history',
    		'user_permissions_relationship',
    		'user_roles',
    		'year_master',
    	];
    	$tables = array_map('reset', \DB::select('SHOW TABLES'));
    	$table_array=array();
    	$db=env('DB_DATABASE');
		foreach($tables as $table)
		{
			if(!in_array($table, $not_to_be_truncated))
			{
				DB::statement("TRUNCATE TABLE $table");
				$this->line("$table table truncated successfully");
			}
		    
		}
		$this->info("Tables truncated successfully");
    }
}
