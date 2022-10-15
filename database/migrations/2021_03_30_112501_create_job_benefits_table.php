<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_benefits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jobID')->unsigned()->nullable();
            $table->integer('benefitID')->unsigned()->nullable();
            $table->timestamps();
        });

        //foreign keys
        Schema::table('job_benefits', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('jobID')->references('id')->on('jobs');
            $table->foreign('benefitID')->references('id')->on('benefits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_benefits');
    }
}
