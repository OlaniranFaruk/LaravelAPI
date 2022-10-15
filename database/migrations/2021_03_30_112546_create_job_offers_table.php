<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobID')->unsigned()->nullable();
            $table->dateTime('creationDate');
            $table->integer('descriptionID')->unsigned()->nullable();
            $table->timestamps();
        });
        //foreign keys
        Schema::table('job_offers', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('jobID')->references('id')->on('jobs');
            $table->foreign('descriptionID')->references('id')->on('job_descriptions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_offers');
    }
}
