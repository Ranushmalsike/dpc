<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransportPriceDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
            DB::table('transpoer_price_details')->insert([
            'trasporot_code' => 'none', 
            'transport_price' => 0.00, 
            'setDef' => 1, 
        ]);

    }
}
