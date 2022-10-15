<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('shipmentId')->unsigned()->nullable();
            $table->integer('flightId')->unsigned()->nullable();
            $table->integer('parcelTypeId')->unsigned()->nullable();
            $table->string('trackingNumber');
            $table->float('weight',8,4);
            $table->integer('height');
            $table->integer('width');
            $table->integer('length');
            $table->string('priority');
            $table->boolean('isAllocated');
            $table->boolean('insurance');
            $table->integer('statusId')->unsigned()->nullable();
            $table->timestamps();

        });

        Schema::table('parcels', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('flightId')->references('id')->on('flights');
            $table->foreign('statusId')->references('id')->on('statuses');
            $table->foreign('shipmentId')->references('id')->on('shipments')->onDelete('cascade');
            $table->foreign('parcelTypeId')->references('id')->on('parcel_types');
        });
    }

//'departureTimeStamp',
//'arrivalTimeStamp',
//'isAllocated',
//'insurance',
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
