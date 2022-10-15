<?php

namespace Database\Seeders;

use App\Models\JobDescription;
use App\Models\Benefit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobDescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        JobDescription::truncate();
            
        $faker = \Faker\Factory::create();
        $degree = [
            "Pre school",
            "Phd",
            "Master",
            "Bachelor"
        ];
        $description = [
            "Experience in php needed",
            "Needs to be able to handle their beer",
            "hello, I'm an easter egg :)",
            "Love for beans required",
            "Drivers license type B or higher"
        ];
        $benefits = Benefit::all()->pluck('id')->toArray();
        for ($I1 = 0; $I1 < 100; $I1++){
            JobDescription::create([
                "degree" => $faker->randomElement($degree),
                "experience" => $faker->numerify('# year(s)'),
                "general" => $faker->randomElement($description),
                "benefits" => $faker->randomElement($benefits)
            ]);
        }

        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
