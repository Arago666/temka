<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardWarsGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_wars_games', function (Blueprint $table) {
            $table->id();

            $table->string('game_number');
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->bigInteger('count_players')->nullable();

            $table->bigInteger('created_user_id')->nullable();

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
        Schema::dropIfExists('card_wars_games');
    }
}
