<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserConfigSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_configs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->json('data');
            $table->timestamps();
        });


        Schema::table('user_configs', function(Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_configs', function(Blueprint $table) {
            $table->dropForeign('user_configs_users_id_foreign');
        });

        Schema::dropIfExists('user_configs');
    }
}
