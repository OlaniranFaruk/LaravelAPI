<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('departmentID')->unsigned()->nullable();
            $table->boolean('available');
            $table->integer('description')->unsigned()->nullable();
            $table->string('hours');
            $table->float('pricePerHour');
            $table->timestamps();
        });
        //foreign keys
        Schema::table('jobs', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('departmentID')->references('id')->on('departments');
            $table->foreign('description')->references('id')->on('job_descriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
