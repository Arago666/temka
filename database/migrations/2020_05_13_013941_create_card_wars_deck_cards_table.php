<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardWarsDeckCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_wars_deck_cards', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('deck_type');
            $table->bigInteger('number');
            $table->string('img');
            $table->bigInteger('card_type');

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
        Schema::dropIfExists('card_wars_deck_cards');
    }
}
