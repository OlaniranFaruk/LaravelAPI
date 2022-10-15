<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderId')->unsigned()->nullable();
            $table->integer('statusId')->unsigned()->nullable();
            $table->string('reason')->nullable();
            $table->integer('depAddressId')->unsigned()->nullable();
            $table->integer('destAddressId')->unsigned()->nullable();
            $table->integer('deliveryTypeId')->unsigned()->nullable();
            $table->string('departureTimeStamp');
            $table->string('arrivalTimeStamp');
            $table->timestamps();

        });
        Schema::table('shipments', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('orderId')->references('id')->on('orders');
            $table->foreign('statusId')->references('id')->on('statuses');
            $table->foreign('depAddressId')->references('id')->on('addresses');
            $table->foreign('destAddressId')->references('id')->on('addresses');
            $table->foreign('deliveryTypeId')->references('id')->on('delivery_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}