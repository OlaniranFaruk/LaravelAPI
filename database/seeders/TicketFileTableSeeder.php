<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\TicketFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        TicketFile::truncate();
        $faker = \Faker\Factory::create();
//        $customers = Customer::all()->pluck('id')->toArray();
        $tickets = Ticket::all()->pluck('id')->toArray();
        for ($i = 0; $i < 500; $i++) {
            TicketFile::create([
                'ticketId' => $faker->randomElement($tickets),
                'userId' => $faker->numberBetween(1,5),
                'isCustomer' => $faker->boolean(50),
                'fileSource' => '/' . implode('/', $faker->words($faker->numberBetween(0, 4))),
                'fileName' => $faker->word,
                'fileType' => $faker->fileExtension,
                'fileSize' => $faker->numberBetween(0, 1000000),

            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
