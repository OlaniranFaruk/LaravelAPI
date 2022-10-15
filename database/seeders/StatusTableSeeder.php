<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Status::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        Status::create(['name' => 'Delivered']);
        Status::create(['name' => 'Underway']);
        Status::create(['name' => 'Cancelled']);
        Status::create(['name' => 'Processing Order']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}