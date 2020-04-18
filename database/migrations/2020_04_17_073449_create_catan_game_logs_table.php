<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatanGameLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catan_game_logs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('movie_number')->nullable();

            $table->string('game_number')->nullable();
            $table->bigInteger('element_type_id')->nullable();
            $table->bigInteger('number')->nullable();

            $table->bigInteger('coordinate_left')->nullable();
            $table->bigInteger('coordinate_top')->nullable();

            $table->bigInteger('status')->nullable();

            $table->bigInteger('color_id')->unsigned()->nullable();

            $table->string('color1_element')->nullable();
            $table->string('color2_element')->nullable();
            $table->string('color3_element')->nullable();

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
        Schema::dropIfExists('catan_game_logs');
    }
}
