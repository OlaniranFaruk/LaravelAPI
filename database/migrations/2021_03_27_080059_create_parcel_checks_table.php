<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcel_checks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parcelId')->unsigned();
            $table->string('location');
            $table->timestamps();

        });
        Schema::table('parcel_checks', function ($table) {
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
        Schema::dropIfExists('parcel_checks');
    }
}
