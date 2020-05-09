<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatanGamePositionPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catan_game_position_players', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->string('user_name')->nullable();
            $table->bigInteger('color_id')->unsigned();

            $table->string('game_number');
            $table->bigInteger('position')->nullable();

            $table->bigInteger('created_user_id')->nullable();

            $table->timestamps();

            $table->foreign('color_id')->references('id')->on('catan_colors');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catan_game_position_players');
    }
}
