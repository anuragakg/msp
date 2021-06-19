<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserRolesAndMappings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Contains Master of user roles
         */
        Schema::create('user_roles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('title', 200);
            $table->string('slug', 200);
            $table->text('description');
            $table->enum('role_type', [2, 1, 0]); //type 2 - role mapping list, type 1 - user management list, type 0 - All roles;
            $table->enum('status', [1, 0]);

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
        Schema::drop('user_roles');
    }
}
