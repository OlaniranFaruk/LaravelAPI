<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Seeder;

class TicketCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TicketCategory::create(['categoryName' => "Order"]);
        TicketCategory::create(['categoryName' => "Account"]);

        TicketCategory::create(['categoryName' => "New feature"]);
        TicketCategory::create(['categoryName' => "Payment"]);
        TicketCategory::create(['categoryName' => "Tracking"]);
        TicketCategory::create(['categoryName' => "Infrastructure"]);

    }
}