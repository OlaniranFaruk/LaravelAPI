<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Order::truncate();

        $faker = \Faker\Factory::create();
        $customers = \App\Models\Customer::all()->pluck('id')->toArray();

        // And now, let's create a few articles in our database:
        Order::create(['customerId' => 1,'totalPrice' => 37.45,'isPaid' => 1,'extraInfo' => 'extra1','orderNr' => 'B210024001']);
        Order::create(['customerId' => 1,'totalPrice' => 120.24,'isPaid' => 1,'extraInfo' => 'extra2','orderNr' => 'B810226051']);
        Order::create(['customerId' => 1,'totalPrice' => 101.80,'isPaid' => 1,'extraInfo' => 'extra3','orderNr' => 'B586182357']);
        Order::create(['customerId' => 1,'totalPrice' => 50,'isPaid' => 0,'extraInfo' => 'extra4','orderNr' => 'B157806718']);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}