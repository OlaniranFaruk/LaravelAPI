<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('flightNumber');
            $table->string('depAirport');
            $table->string('destAirport');
            $table->integer('reservedWeight');
            $table->dateTime('deptTime');
            $table->dateTime('arrivalTime');
            $table->integer('reservedVolume');
            $table->string('airlineName');
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
        Schema::dropIfExists('flights');
    }
}
