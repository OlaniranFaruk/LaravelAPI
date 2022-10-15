<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Employee::truncate();

        //$password = Hash::make('password123');

        $faker = \Faker\Factory::create();
        $jobs = Job::all()->pluck('id')->toArray();

        for ($I1 = 0; $I1 < 500; $I1++){
            Employee::create([
                'employeeFirstName' => $faker->firstName,
                'employeeLastName' => $faker->lastName,
                'employeeMailAddress' => $faker->email,
                'employeePhoneNumber' => $faker->numerify('+32 ########'),
                'employeePassword' => $faker->password,
                'employeeSalary' => $faker->numberBetween($min = 1000, $max = 5000),
                'employeeJobID' => $faker->randomElement($jobs),
                'employeeBirthDate' => $faker->dateTimeBetween($startDate = '-70 years', $endDate = '-30 years', $timezone = null),
                'employeeIsAdmin' => $faker->boolean
            ]);
        }


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
