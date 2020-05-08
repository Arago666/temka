<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatanGamePlayerCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catan_game_player_cards', function (Blueprint $table) {
            $table->id();

            $table->string('game_number');
            $table->bigInteger('position_id');

            $table->bigInteger('type_res');
            $table->bigInteger('count_res');

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
        Schema::dropIfExists('catan_game_player_cards');
    }
}
