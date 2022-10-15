<?php

namespace Database\Seeders;

use App\Models\Parcel;
use App\Models\ParcelCheck;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcelCheckTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ParcelCheck::truncate();

        $faker = \Faker\Factory::create();
        $parcels = Parcel::all()->pluck('id')->toArray();
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 500; $i++) {


            ParcelCheck::create([
                'parcelId' => $faker->randomElement($parcels),
                'location' => $faker->city
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}