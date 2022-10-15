<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Flight::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 500; $i++) {


            Flight::create([
                'flightNumber' => $faker->randomNumber(5),
                'depAirport' => $faker->city,
                'destAirport' => $faker->city,
                'reservedWeight' => $faker->numberBetween(1000 - 10000),
                'deptTime' => $faker->dateTime('now'),
                'arrivalTime' => $faker->dateTime('now'),
                'reservedVolume' => $faker->numberBetween(1000 - 10000),
                'airlineName' => $faker->colorName,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
