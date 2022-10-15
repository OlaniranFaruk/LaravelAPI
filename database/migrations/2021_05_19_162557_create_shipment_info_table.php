<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipmentId')->unsigned()->nullable();
            $table->string('senderName');
            $table->string('receiverName');

            $table->timestamps();
        });
        Schema::table('shipment_infos', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('shipmentId')->references('id')->on('shipments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_info');
    }
}
