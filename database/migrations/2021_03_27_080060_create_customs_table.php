<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parcelId')->unsigned()->nullable();
            $table->integer('totalPrice');
            $table->string('customName');
            $table->string('customSize');
            $table->timestamps();
        });
        Schema::table('customs', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('parcelId')->references('id')->on('parcels');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customs');
    }
}
