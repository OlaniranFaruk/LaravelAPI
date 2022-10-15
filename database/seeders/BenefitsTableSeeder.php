<?php

namespace Database\Seeders;

use App\Models\Benefit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BenefitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Benefit::truncate();
            
        $faker = \Faker\Factory::create();
        $benefits = [
            "extra cheese",
            "more ping-pong balls",
            "company car",
            "company house",
            "free flights",
            "full coverage on health care"
        ];

        for ($I1 = 0; $I1 < 100; $I1++){
            Benefit::create([
                'description' => $faker->randomElement($benefits)
            ]);
        }

        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
