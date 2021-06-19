<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserPermissionSchemas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /**
         * Permissions Master
         */
        Schema::create('permissions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('alias', 100)->index();
            $table->string('name', 100);
            $table->string('group', 100);
            $table->text('description');

            $table->bigInteger('created_by')->unsigned()->index();
            $table->bigInteger('updated_by')->unsigned()->index();

            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * Mapping of roles and permissions table
         * 
         */
        Schema::create('role_permissions_relationship', function (Blueprint $table) {
            $table->integer('role_id')->index();
            $table->integer('permission_id')->index();
            $table->timestamps();
        });
		
		Schema::create('user_permissions_relationship', function (Blueprint $table) {
            $table->integer('user_id')->index();
            $table->integer('permission_id')->index();
            $table->bigInteger('created_by')->unsigned()->index();
            $table->bigInteger('updated_by')->unsigned()->index();
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
        Schema::drop('permissions');
        Schema::drop('role_permissions_relationship');
    }
}
