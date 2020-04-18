<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatanCoordinateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catan_coordinate_elements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('element_type_id');
            $table->bigInteger('number');
            $table->bigInteger('coordinate_left');
            $table->bigInteger('coordinate_top');
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
        Schema::dropIfExists('catan_coordinate_elements');
    }
}
