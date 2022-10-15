<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\ShipmentInfo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShipmentInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Shipment::truncate();
        $faker = \Faker\Factory::create();
        $shipments = Shipment::all()->pluck('id')->toArray();
        for ($i = 0; $i < 10; $i++) {
            ShipmentInfo::create([
                'shipmentId' => $faker->numberBetween(1,5),
                'senderName' => $faker->firstName." ".$faker->lastName,
                'receiverName' => $faker->firstName." ".$faker->lastName,

            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
