<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\DeliveryType;
use App\Models\Flight;
use App\Models\Order;
use App\Models\Parcel;
use App\Models\ParcelTpe;
use App\Models\Shipment;
use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Storage\Proxy\SessionHandlerProxy;

class ShipmentTableSeeder extends Seeder
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
        $orders = Order::all()->pluck('id')->toArray();
        $statuses = Status::all()->pluck('id')->toArray();
        $addresses = Address::all()->pluck('id')->toArray();
        $deliveryTypes = DeliveryType::all()->pluck('id')->toArray();

        Shipment::create(['orderId' => 0,'statusId' => 3,'reason' => 'Lorum ipsum','depAddressId' => 1,'destAddressId' => 3,'deliveryTypeId' => 1,'arrivalTimeStamp' => '1619442298','departureTimeStamp' => '1619532298']);
        Shipment::create(['orderId' => 1,'statusId' => 1,'reason' => NULL,'depAddressId' => 2,'destAddressId' => 3,'deliveryTypeId' => 2,'arrivalTimeStamp' => '1619525098','departureTimeStamp' => '1619784298']);
        Shipment::create(['orderId' => 0,'statusId' => 2,'reason' => NULL,'depAddressId' => 3,'destAddressId' => 2,'deliveryTypeId' => 3,'arrivalTimeStamp' => '1619611498','departureTimeStamp' => '1619640298']);
        Shipment::create(['orderId' => 1,'statusId' => 2,'reason' => NULL,'depAddressId' => 1,'destAddressId' => 4,'deliveryTypeId' => 2,'arrivalTimeStamp' => '1619553898','departureTimeStamp' => '1619726698']);
        Shipment::create(['orderId' => 2,'statusId' => 1,'reason' => NULL,'depAddressId' => 4,'destAddressId' => 3,'deliveryTypeId' => 2,'arrivalTimeStamp' => '1619730298','departureTimeStamp' => '1619989498']);
        Shipment::create(['orderId' => 2,'statusId' => 1,'reason' => NULL,'depAddressId' => 3,'destAddressId' => 2,'deliveryTypeId' => 3,'arrivalTimeStamp' => '1619903098','departureTimeStamp' => '1620115498']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}