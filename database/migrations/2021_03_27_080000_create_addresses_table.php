<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('addressName');
            $table->string('addressNumber');
            $table->string('addressStreet');
            $table->string('addressPlace');
            $table->string('addressZip');
            $table->string('addressCountry');
            $table->string('addressState');
            $table->string('addressMailBoxNumber')->nullable();
            $table->string('addressExtraInfo')->nullable();
            $table->string('loadingPresent');
            $table->string('trailerAccess');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adresses');
    }
}
