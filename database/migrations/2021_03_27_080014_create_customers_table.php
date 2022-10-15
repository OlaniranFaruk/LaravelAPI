<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->bigInteger('businessId')->unsigned()->nullable();
            $table->integer('addressId')->unsigned()->nullable();
            $table->boolean('isUser')->nullable();


            $table->timestamps();
        });

        Schema::table('customers', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('businessId')->references('id')->on('businesses');
            $table->foreign('addressId')->references('id')->on('addresses');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
