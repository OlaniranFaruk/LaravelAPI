<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPasswordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_passwords', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customerId')->unsigned()->nullable();
            $table->string('password');
            $table->timestamps();
        });

        Schema::table('customer_passwords', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('customerid')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_passwords');
    }
}
