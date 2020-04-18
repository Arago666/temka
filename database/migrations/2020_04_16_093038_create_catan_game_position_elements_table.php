<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatanGamePositionElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catan_game_position_elements', function (Blueprint $table) {
            $table->id();

            $table->string('game_number');
            $table->bigInteger('element_type_id');
            $table->bigInteger('number');
            $table->bigInteger('status')->nullable();
            $table->bigInteger('color_id')->unsigned()->nullable();

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
        Schema::dropIfExists('catan_game_position_elements');
    }
}
