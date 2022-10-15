<?php

namespace Database\Seeders;

use App\Models\TicketState;
use Illuminate\Database\Seeder;

class TicketStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketState::create(['stateName' => "State 1"]);
        TicketState::create(['stateName' => "State 2"]);
        TicketState::create(['stateName' => "State 3"]);
    }
}
