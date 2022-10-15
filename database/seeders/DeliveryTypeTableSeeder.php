<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DeliveryType::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
            DeliveryType::create([
                'name' => 'Normal',
                'pickup' => 'Get email for further instructions and exact date when package can be picked up.',
                'delivery' => 'There will be an estimated time of arrival. We are not responsible for unforseen delays.',
                'priceFactor' => 1]);
            DeliveryType::create([
                'name' => 'Express',
                'pickup' => 'Package will be on the airport the same day or between 48 hours. Pickup will be guaranteed if you book before a specific time.',
                'delivery' => 'There will be an estimated time of arrival. We are not responsible for unforseen delays.',
                'priceFactor' => 1.5]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
