<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class credit_d3s extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
            DB::table('credit_d3s')->insert([
                ['type' => 'none'],
                ['type' => 'Pending'],
                ['type' => 'Confirmed']
    ]);
    }
}
