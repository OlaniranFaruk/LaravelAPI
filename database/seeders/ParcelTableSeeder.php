<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Custom;
use App\Models\DeliveryType;
use App\Models\Flight;
use App\Models\Order;
use App\Models\Parcel;
use App\Models\ParcelTpe;
use App\Models\ParcelType;
use App\Models\Shipment;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Parcel::truncate();

        $faker = \Faker\Factory::create();
        $shipments = Shipment::all()->pluck('id')->toArray();
        $flights = Flight::all()->pluck('id')->toArray();
        $parcelTypes = ParcelType::all()->pluck('id')->toArray();

        Parcel::create(['shipmentId' => 1,'parcelTypeId' => 1,'trackingNumber' => 'none','insurance' => 0,'weight' => 490,'height' => 89,'width' => 20,'length' => 32,'priority' => 'Lorum','isAllocated' => 0,'flightId' => 0,'statusId'=> 1]);
        Parcel::create(['shipmentId' => 1,'parcelTypeId' => 1,'trackingNumber' => '4813495196242','insurance' => 1,'weight' => 205,'height' => 100,'width' => 36,'length' => 50,'priority' => 'Lorum','isAllocated' => 1,'flightId' => 2,'statusId'=> 1]);
        Parcel::create(['shipmentId' => 1,'parcelTypeId' => 1,'trackingNumber' => '8327293630830','insurance' => 0,'weight' => 329,'height' => 52,'width' => 16,'length' => 40,'priority' => 'Lorum','isAllocated' => 1,'flightId' => 3,'statusId'=> 1]);
        Parcel::create(['shipmentId' => 1,'parcelTypeId' => 1,'trackingNumber' => '2659502955943','insurance' => 1,'weight' => 600.0001,'height' => 56,'width' => 33,'length' => 52,'priority' => 'Lorum','isAllocated' => 1,'flightId' => 1,'statusId'=> 1]);
        Parcel::create(['shipmentId' => 1,'parcelTypeId' => 1,'trackingNumber' => '1384537724660','insurance' => 0,'weight' => 45,'height' => 60,'width' => 136,'length' => 47,'priority' => 'Lorum','isAllocated' => 1,'flightId' => 2,'statusId'=> 1]);
        Parcel::create(['shipmentId' => 1,'parcelTypeId' => 1,'trackingNumber' => 'none','insurance' => 1,'weight' => 500,'height' => 40,'width' => 30,'length' => 132,'priority' => 'Lorum','isAllocated' => 0,'flightId' => 0,'statusId'=> 1]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
