<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserExtraFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->tinyInteger('role',false,true)->after('email')->index();
            $table->string('user_name', 25)->after('id');
            $table->string('middle_name', 25)->after('name')->nullable();
            $table->string('last_name', 25)->after('middle_name')->nullable();
            $table->enum('status', [1,0])->after('role');
            $table->unsignedBigInteger('created_by')->unsigned()->after('role')->index();
            $table->bigInteger('updated_by')->after('created_by')->unsigned()->index();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn([
                'role',
                'user_name',
                'middle_name',
                'last_name',
                'created_by'
            ]);
            $table->dropSoftDeletes();
        });
    }
}
