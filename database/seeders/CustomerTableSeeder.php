<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Parcel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTableSeeder extends Seeder
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
        $businesses = Business::all()->pluck('id')->toArray();
        $addresses = Address::all()->pluck('id')->toArray();

        Customer::create(['addressId' => 1,'businessId' => NULL,'email' => 'Barbara.real@gmail.com','firstName' => 'Barbara','lastName' => 'Strong','phoneNumber' => '+35319609524','isUser' => '1']);
        Customer::create(['addressId' => 2,'businessId' => NULL,'email' => 'Johnny.bravo@gmail.com','firstName' => 'Johnny','lastName' => 'Bravo','phoneNumber' => '+7-925-5512-832','isUser' => '1']);
        Customer::create(['addressId' => 3,'businessId' => 1,'email' => 'Ed.eddy@gmail.com','firstName' => 'Ed','lastName' => 'Eddy','phoneNumber' => '+34-755-5668','isUser' => '1']);
        Customer::create(['addressId' => 4,'businessId' => 2,'email' => 'Tom.jerry@gmail.com','firstName' => 'Tom','lastName' => 'Jerry','phoneNumber' => '+20-105-5514-985 ','isUser' => '1']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
