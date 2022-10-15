<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Department::truncate();

        $faker = \Faker\Factory::create();
        $departments = [
            'Sales',
            'Customer care',
            'ping pong training',
            'management',
            'package repair'
        ];

        for ($I1 = 0; $I1 < 100; $I1++){
            Department::create([
                'name' => $departments[$I1 % 5],
                'head' => $faker->name,
                'location' => $faker->city
            ]);
        }


        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
