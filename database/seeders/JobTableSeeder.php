<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\JobDescription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Job::truncate();

        $faker = \Faker\Factory::create();
        $description = JobDescription::all()->pluck('id')->toArray();

        for ($I1 = 0; $I1 < 100; $I1++){
            Job::create([
                'name' => $faker->jobTitle,
                'departmentID' => $faker->randomNumber(5),
                'available' => $faker->boolean,
                'description' => $faker->randomElement($description),
                'hours' => $faker->numerify('0#u00 - 1#u30'),
                'pricePerHour' => $faker->randomFloat($nbMaxDecimals = 2, $min = 8, $max = 20)
            ]);
        }


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
} 