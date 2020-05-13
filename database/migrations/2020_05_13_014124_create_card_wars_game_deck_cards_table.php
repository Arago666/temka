<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardWarsGameDeckCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_wars_game_deck_cards', function (Blueprint $table) {
            $table->id();

            $table->string('game_number');
            $table->bigInteger('position_id');

            $table->bigInteger('deck_type');

            $table->bigInteger('card_number');
            $table->bigInteger('card_position');

            $table->bigInteger('status_knockout');
            $table->bigInteger('active_deck_status');

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
        Schema::dropIfExists('card_wars_game_deck_cards');
    }
}
