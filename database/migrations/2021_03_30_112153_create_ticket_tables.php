<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // CREATES TABLES
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->text('description');
            $table->integer('priority');
            $table->dateTime('startDate')->nullable();
            $table->dateTime('endDate')->nullable();
            $table->dateTime('lockedUntil')->nullable();
            $table->integer('lockedById')->unsigned()->nullable();
            $table->integer('categoryId')->unsigned()->nullable();
            $table->integer('assignedEmployeeId')->unsigned()->nullable();
            $table->integer('stateId')->unsigned()->nullable();
            $table->integer('userId');
            $table->boolean('isCustomer')->default(false);
            $table->timestamps();
        });

        Schema::create('ticket_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoryName');
            $table->timestamps();
        });

        Schema::create('ticket_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stateName');
            $table->timestamps();
        });

        Schema::create('ticket_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fileSource');
            $table->string('fileName');
            $table->string('fileType');
            $table->unsignedBigInteger('fileSize');
            $table->integer('ticketId')->unsigned()->nullable();
            $table->integer('userId');
            $table->boolean('isCustomer')->default(false);
            $table->timestamps();
        });

        Schema::create('ticket_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('logType');
            $table->integer('ticketId')->unsigned()->nullable();
            $table->integer('userId');
            $table->boolean('isCustomer')->default(false);
            $table->timestamps();
        });


        // DEFINE FOREIGN KEY CONSTRAINTS
        Schema::table('tickets', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('categoryId')->references('id')->on('ticket_categories');
            $table->foreign('stateId')->references('id')->on('ticket_states');

            $table->foreign('assignedEmployeeId')->references('id')->on('employees');
            $table->foreign('lockedById')->references('id')->on('employees');


        });

        Schema::table('ticket_files', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('ticketId')->references('id')->on('tickets');

        });

        Schema::table('ticket_logs', function ($table) {
            $table->engine = 'InnoDB';
            $table->foreign('ticketId')->references('id')->on('tickets');
;

        });

        // CAN'T CREATE A FK CONSTRAINT ON USERID BECAUSE IT CAN REFERENCE EITHER ONE OF TWO TABLES
        // AS PER THE ERD. WEIRD MODELING
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('ticket_categories');
        Schema::dropIfExists('ticket_states');
        Schema::dropIfExists('ticket_files');
        Schema::dropIfExists('ticket_logs');
    }
}
