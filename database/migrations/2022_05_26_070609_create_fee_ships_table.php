<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_ships', function (Blueprint $table) {
            $table->increments('fee_id');
            $table->integer('fee_cityid');
            $table->integer('fee_provinceid');
            $table->integer('fee_wardid');
            $table->integer('fee_ship');
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
        Schema::dropIfExists('fee_ships');
    }
}
