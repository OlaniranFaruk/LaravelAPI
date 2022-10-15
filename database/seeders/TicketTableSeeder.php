<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TicketState;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Ticket::truncate();
        $faker = \Faker\Factory::create();

        //$customers = Customer::all()->pluck('id')->toArray();
        $categories = TicketCategory::all()->pluck('id')->toArray();
        $states = TicketState::all()->pluck('id')->toArray();
        $employees= Employee::all()->pluck('id')->toArray();
        for ($i = 0; $i < 500; $i++) {
            Ticket::create([
                'userId' => $faker->numberBetween(1,5),
                'categoryId' => $faker->randomElement($categories),
                'stateId' => $faker->randomElement($states),
                'isCustomer' => true,
                'subject' => $faker->sentence,
                'assignedEmployeeId' => $faker->randomElement($employees),
                'description' => $faker->text,
                'priority' => $faker->numberBetween(0,3),
                'startDate' => $faker->dateTime('now'),
                'endDate' => $faker->dateTime('now'),
                'lockedUntil' => $faker->dateTime('now'),
                'lockedById' => $faker->randomElement($employees),

            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
