<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        \App\Models\CustomerPassword::truncate();

        $faker = \Faker\Factory::create();
        $customers = Customer::all()->pluck('id')->toArray();
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < sizeof($customers); $i++) {


            \App\Models\CustomerPassword::create([
                'customerId' => $i+1,
                'password' => $faker->password,
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
