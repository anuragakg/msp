<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserManagementSchemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        /**
         * User mapping table for assigning user to another user.
         * For eg Mapping Surveyor to Mentoring Organisation.
         */
        Schema::create('users_mapping', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('parent_id')->index()->comment('Parent user.');
            $table->bigInteger('child_id')->index()->comment('User assigned to parent user.');
            $table->bigInteger('created_by')->index()->comment('User creating this mapping.');

            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * User bank details of the user.
         */
        Schema::create('user_bank_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index();

            /**
             * Account holder's name
             * Used in user management and surveyor/supervisor form.
             * "name" is only required in user management form.
             */
            $table->string('ac_holder_name', 25)->nullable(); // user management field
            $table->string('branch_name', 25)->nullable(); // sruveyor supervisor form field
            $table->string('bank_name', 25);
            $table->string('bank_ac_no',20)->unique();
            $table->string('ifsc_code', 11);
            /** Mobile no if required */
            $table->string('mobile_no',15)->nullable();

            $table->bigInteger('created_by')->unsigned()->index();
            $table->bigInteger('updated_by')->unsigned()->index();
            
            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Contains additional details for user like state, date of birth,
         * mobile no etc.
         */
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->index();

            $table->date('dob')->nullable();
            $table->integer('state')->nullable();
            $table->integer('district')->nullable();
            $table->integer('block')->nullable();

            /**
             * As per discussion and further possible scope
             * mobile no. is now shifted to user's table.
             */
            // $table->bigInteger('mobile_no')->nullable();
            $table->integer('pin_code')->nullable();
            $table->bigInteger('landline_no')->nullable();
            $table->integer('id_proof_type')->index()->nullable();
            $table->string('id_proof_value', 17)->nullable();
            $table->string('official_address', 250)->nullable();
            $table->integer('department')->index()->nullable();
            $table->integer('designation')->index()->nullable();

            $table->bigInteger('created_by')->unsigned()->index();
            $table->bigInteger('updated_by')->unsigned()->index();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('users_mapping');
        Schema::drop('user_bank_details');
        Schema::drop('user_details');
    }
}
