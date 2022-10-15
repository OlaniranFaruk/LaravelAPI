<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Address::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:

        Address::create(['addressName' => 'private','addressStreet' => 'Mt. Nebo Hollyfort','addressNumber' => '69','addressZip' => 'Y25','addressPlace' => 'Gorey','addressCountry' => 'Ireland','addressState' => 'County Wexford','addressMailBoxNumber' => '101','addressExtraInfo' => 'NULL','loadingPresent' => 1,'trailerAccess' => 1]);
        Address::create(['addressName' => 'private','addressStreet' => 'Krasnoarmeyskaya Ul.','addressNumber' => '69','addressZip' => '600031','addressPlace' => 'Vladimir','addressCountry' => 'Russia','addressState' => 'Vladimirskaya oblast','addressMailBoxNumber' => 'bld. 45/a, appt. 30','addressExtraInfo' => 'Elevator is broken','loadingPresent' => 0,'trailerAccess' => 0]);
        Address::create(['addressName' => 'bussiness','addressStreet' => 'Inglaterra','addressNumber' => '69','addressZip' => '18640','addressPlace' => 'Padul','addressCountry' => 'Spain','addressState' => 'granada','addressMailBoxNumber' => '91','addressExtraInfo' => 'NULL','loadingPresent' => 0,'trailerAccess' => 1]);
        Address::create(['addressName' => 'bussiness','addressStreet' => 'Abdel Hamid Loutfi St. MOHAN DESEEN','addressNumber' => '69','addressZip' => 'NULL','addressPlace' => 'Giza','addressCountry' => 'Egypt','addressState' => 'giza','addressMailBoxNumber' => '10','addressExtraInfo' => 'You will have to undergo some security control','loadingPresent' => 1,'trailerAccess' => 0]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}