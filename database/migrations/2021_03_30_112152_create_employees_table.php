<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employeeFirstName');
            $table->string('employeeLastName');
            $table->string('employeeMailAddress');
            $table->string('employeePhoneNumber');
            $table->string('employeePassword');
            $table->integer('employeeSalary');
            $table->integer('employeeJobID')->unsigned()->nullable();
            $table->dateTime('employeeBirthDate');
            $table->boolean('employeeIsAdmin');
            $table->timestamps();
        });
        //foreign keys
        Schema::table('employees', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('employeeJobID')->references('id')->on('jobs');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}