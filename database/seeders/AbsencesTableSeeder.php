<?php

namespace Database\Seeders;

use App\Models\Absence;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Absence::truncate();

        $faker = \Faker\Factory::create();
        $employees = Employee::all()->pluck('id')->toArray();
        $reasons = [
            "I have a family emergency",
            "My cat is sick",
            "I painted my room and it's not going to watch itself dry",
            "Idk I just don't feel like it...",
            "My dog ate my car keys",
            "Lost my will to live",
            "My butler fell down the stairs and broke his toe",
            "Corona"
        ];

        for ($I1 = 0; $I1 < 500; $I1++){
            Absence::create([
                'employeeID' => $faker->randomElement($employees),
                'startDate' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = '-1 years', $timezone = null),
                'endDate' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null),
                'reason' => $faker->randomElement($reasons),
                'leaveType' => $faker->numberBetween($min = 1, $max = 3),
                'approved' => $faker->boolean()
            ]);
        }


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
