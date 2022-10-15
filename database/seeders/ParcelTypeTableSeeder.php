<?php

namespace Database\Seeders;

use App\Models\ParcelTpe;
use App\Models\ParcelType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParcelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ParcelType::truncate();

        $faker = \Faker\Factory::create();
        ParcelType::create(['name' => 'Envelope','minWidth' => 0.1,'maxWidth' => 0.5,'minDepth' => 9,'maxDepth' => 12.5,'minHeight' => 14,'maxHeight' => 23.5,'minWeight' => 0.001,'maxWeight' => 0.050]);
        ParcelType::create(['name' => 'Box','minWidth' => 10,'maxWidth' => 60,'minDepth' => 20,'maxDepth' => 80,'minHeight' => 10,'maxHeight' => 60,'minWeight' => 0.200,'maxWeight' => 70]);
        ParcelType::create(['name' => 'Pallet','minWidth' => 1,'maxWidth' => 300,'minDepth' => 60,'maxDepth' => 130,'minHeight' => 40,'maxHeight' => 240,'minWeight' => 10,'maxWeight' => 999]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}