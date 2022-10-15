<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\TicketLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        TicketLog::truncate();
        $faker = \Faker\Factory::create();
        //$customers = Customer::all()->pluck('id')->toArray();
        $tickets = Ticket::all()->pluck('id')->toArray();
        for ($i = 0; $i < 500; $i++) {
            TicketLog::create([
                'ticketId' => $faker->randomElement($tickets),
                'userId' => $faker->numberBetween(1,5),
                'isCustomer' => true,
                'description' => $faker->sentence,
                'logType' => "NEW",

            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
