<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Prevent Error while running migrations
        Schema::defaultStringLength(191);

        /**
         * Age Validation Check
         */
        Validator::extend('olderThan', function ($attribute, $value, $parameters) {
            if (!$value) {
                return true;
            }
            $minAge = (!empty($parameters)) ? (int) $parameters[0] : 18;
            $now = Carbon::now();            
            try {
                $createDate = Carbon::createFromFormat('d/m/Y', $value);
            } catch (\Throwable $th) {
                return false;
            }
            $diff = $createDate->diffInYears($now);
            
            return $diff >= $minAge;
        });

        Validator::extend('unique_custom', function ($attribute, $value, $parameters)
        {
            // Get the parameters passed to the rule
            list($table, $field, $field2, $field2Value) = $parameters;

            // Check the table and return true only if there are no entries matching
            // both the first field name and the user input value as well as
            // the second field name and the second field value
            return DB::table($table)->where($field, $value)->where($field2, $field2Value)->count() == 0;
        });
		
		Validator::extend('unique_custom_with_deleted', function ($attribute, $value, $parameters)
        {
            // Get the parameters passed to the rule
            list($table, $field, $field2, $field2Value) = $parameters;

            // Check the table and return true only if there are no entries matching
            // both the first field name and the user input value as well as
            // the second field name and the second field value
            return DB::table($table)->where($field, $value)->where($field2, $field2Value)->where('deleted_at',NULL)->count() == 0;
        });

        /**
         * validation for title
         */
        Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        /**
         * Validation for address
         */
        Validator::extend('valid_address', function($attribute, $value)
        {
            return preg_match('/^[a-zA-Z0-9,.:; -\/]+$/', $value);
        });
		/**
         * Validation for disallow first special character in address
         */
        Validator::extend('restrict_first_special', function($attribute, $value)
        {
			if($value!=''){
				$first_char=substr($value,0,1);
				if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $first_char))
				{
					return false;
				}else{
					return true;
				}
			}else{
					return true;
			}
        }, 'First character should not be special character in :attribute');


        /**
         * validation for numeric decimal fields
         */
        Validator::extend('decimal_value_qty', function($attribute, $value)
        {
            return preg_match('/^\d{0,4}(\.\d{1,4})?$/', $value);
        }," :attribute should not contain more than 4 digits before decimal and more than 4 digits after decimal");


        /**
         * validation for numeric decimal fields
         */
        Validator::extend('decimal_value_amount', function($attribute, $value)
        {
            return preg_match('/^\d{0,6}(\.\d{1,4})?$/', $value);
        }," :attribute should not contain more than 6 digits before decimal and more than 4 digits after decimal");


        /**
         * validation for numeric decimal fields
         */
        Validator::extend('decimal_value', function($attribute, $value)
        {
            return preg_match('/^\d{0,15}(\.\d{1,4})?$/', $value);
        }," :attribute should not contain more than 15 digits before decimal and more than 4 digits after decimal");
    }
}
