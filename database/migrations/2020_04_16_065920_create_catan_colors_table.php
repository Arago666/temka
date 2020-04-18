<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatanColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catan_colors', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->string('name')->nullable();

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
        Schema::dropIfExists('catan_colors');
    }
}
