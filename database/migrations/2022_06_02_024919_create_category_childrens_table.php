<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_childrens', function (Blueprint $table) {
            $table->increments('category_childrens_id');
            $table->text('category_childrens_name');
            $table->string('category_childrens_des')->nullable();
            $table->integer('category_childrens_status');
            $table->integer('category_id');
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
        Schema::dropIfExists('category_childrens');
    }
}
