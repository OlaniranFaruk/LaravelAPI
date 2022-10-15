<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employeeID')->unsigned()->nullable();
            $table->dateTime('startDate');
            $table->dateTime('endDate');
            $table->string('reason');
            $table->integer('leaveType');
            $table->boolean('approved');
            $table->timestamps();
        });
        //foreign keys
        Schema::table('absences', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('employeeID')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absences');
    }
}