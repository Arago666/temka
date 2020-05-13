<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardWarsGamePlayerCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_wars_game_player_cards', function (Blueprint $table) {
            $table->id();

            $table->string('game_number');
            $table->bigInteger('position_id'); //Позиция игрока (связь с таблицей cardwars_game_position_players полем position)

            $table->bigInteger('number_card'); //Номер карты (1-40) или 1-4 для больших карт на столе

            $table->bigInteger('status'); //1 - в руке, 2 - на поле, 3 - в атаке, 4 - хлюпнута, 5 - здание, 6 - стартовое поле (1 из 4)
            $table->bigInteger('card_type'); //1 - карта (одна из 40), 2 - стартовое поле (одно из 4

            $table->bigInteger('shirt_card'); //1 - картинкой вверх,   2 - рубашкой вверх (не видно карту)

            $table->bigInteger('position_card'); //1-4 позиция за столом, 0 - на руке


            $table->bigInteger('hp'); //Хп монстра, если он на столе

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
        Schema::dropIfExists('card_wars_game_player_cards');
    }
}
