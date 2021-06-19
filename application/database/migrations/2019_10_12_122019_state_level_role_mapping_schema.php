<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StateLevelRoleMappingSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * State Level Role Mapping for users.
         * 
         */
        Schema::create('state_level_role_relationship', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->tinyInteger('state_id')->index();
            $table->tinyInteger('level_id')->index();
            $table->tinyInteger('role_id')->index();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });


        /**
         * Levels Master 
         * to be used in state level role relationship maybe other places as well.
         */
        Schema::create('levels_master', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->text('description');
            $table->enum('status',[1,0]);

            $table->bigInteger('created_by')->unsigned()->index();
            $table->bigInteger('updated_by')->unsigned()->index();

            $table->softDeletes();
            $table->timestamps();
        });

        /**
         * States Master
         */
        if (!Schema::hasTable('states_master')) {
            Schema::create('states_master', function (Blueprint $table) {
                $table->tinyIncrements('id');
                $table->string('title', 100);
                $table->string('code');
                $table->enum('status',[1,0]);

                $table->bigInteger('created_by')->unsigned()->index();
                $table->bigInteger('updated_by')->unsigned()->index();

                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('state_level_role_relationship');
        Schema::drop('levels_master');
        if (!Schema::hasTable('states_master')) {
            Schema::drop('states_master');
        }
    }
}
