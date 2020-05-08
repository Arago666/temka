<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatanGameTurnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catan_game_turns', function (Blueprint $table) {
            $table->id();

            $table->string('game_number');
            $table->bigInteger('turn_number');
            $table->bigInteger('position_id');

            $table->bigInteger('dice_one');
            $table->bigInteger('dice_two');

            $table->bigInteger('count_card_one');
            $table->bigInteger('count_card_two');
            $table->bigInteger('count_card_tree');
            $table->bigInteger('count_card_four');
            $table->bigInteger('count_card_five');

            $table->bigInteger('card_dev_type');

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
        Schema::dropIfExists('catan_game_turns');
    }
}
