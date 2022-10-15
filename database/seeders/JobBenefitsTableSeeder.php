<?php

namespace Database\Seeders;

use App\Models\JobBenefit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobBenefitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        JobBenefit::truncate();
            
        $faker = \Faker\Factory::create();

        for ($I1 = 0; $I1 < 100; $I1++){
            JobBenefit::create([
                'jobID' => $faker->randomNumber(5),
                'benefitID' => $faker->randomNumber(5)
            ]);
        }

        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

