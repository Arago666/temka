<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardWarsGamePositionPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_wars_game_position_players', function (Blueprint $table) {
            $table->id();

            $table->string('game_number');
            $table->bigInteger('user_id')->unsigned();
            $table->string('user_name')->nullable();
            $table->bigInteger('color_id')->unsigned();


            $table->bigInteger('position')->nullable();

            $table->bigInteger('hp')->nullable();
            $table->bigInteger('deck_type')->nullable();

            $table->timestamps();

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
        Schema::dropIfExists('card_wars_game_position_players');
    }
}
