<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllowanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('allowance_tbs')->insert([
            ['start_salary' => 0.00, 'end_star' => 500.00, 'allowance' => 250.00],
            ['start_salary' => 501.00, 'end_star' => 1000.00, 'allowance' => 300.00],
            ['start_salary' => 1001.00, 'end_star' => 1500.00, 'allowance' => 350.00],
            ['start_salary' => 1501.00, 'end_star' => 2000.00, 'allowance' => 400.00],
            ['start_salary' => 2001.00, 'end_star' => 2500.00, 'allowance' => 450.00],
            ['start_salary' => 2501.00, 'end_star' => 3000.00, 'allowance' => 500.00],
            ['start_salary' => 3001.00, 'end_star' => 3500.00, 'allowance' => 550.00],
            ['start_salary' => 3501.00, 'end_star' => 4000.00, 'allowance' => 600.00],
            ['start_salary' => 4001.00, 'end_star' => 4500.00, 'allowance' => 650.00],
            ['start_salary' => 4501.00, 'end_star' => 5000.00, 'allowance' => 700.00],
            ['start_salary' => 5001.00, 'end_star' => 5500.00, 'allowance' => 750.00],
            ['start_salary' => 5501.00, 'end_star' => 6000.00, 'allowance' => 800.00],
            ['start_salary' => 6001.00, 'end_star' => 6500.00, 'allowance' => 850.00],
            ['start_salary' => 6501.00, 'end_star' => 7000.00, 'allowance' => 900.00],
            ['start_salary' => 7001.00, 'end_star' => 7500.00, 'allowance' => 950.00],
            ['start_salary' => 7501.00, 'end_star' => 8000.00, 'allowance' => 1000.00],
            ['start_salary' => 8001.00, 'end_star' => 8500.00, 'allowance' => 1050.00],
            ['start_salary' => 8501.00, 'end_star' => 9000.00, 'allowance' => 1100.00],
            ['start_salary' => 9001.00, 'end_star' => 9500.00, 'allowance' => 1150.00],
            ['start_salary' => 9501.00, 'end_star' => 10000.00, 'allowance' => 1200.00],
            ['start_salary' => 10001.00, 'end_star' => 10500.00, 'allowance' => 1250.00],
            ['start_salary' => 10501.00, 'end_star' => 11000.00, 'allowance' => 1300.00],
            ['start_salary' => 11001.00, 'end_star' => 11500.00, 'allowance' => 1350.00],
            ['start_salary' => 11501.00, 'end_star' => 12000.00, 'allowance' => 1400.00],
            ['start_salary' => 12001.00, 'end_star' => 12500.00, 'allowance' => 1450.00],
            ['start_salary' => 12501.00, 'end_star' => 13000.00, 'allowance' => 1500.00],
            ['start_salary' => 13001.00, 'end_star' => 13500.00, 'allowance' => 1550.00],
            ['start_salary' => 13501.00, 'end_star' => 14000.00, 'allowance' => 1600.00],
            ['start_salary' => 14001.00, 'end_star' => 14500.00, 'allowance' => 1650.00],
            ['start_salary' => 14501.00, 'end_star' => 15000.00, 'allowance' => 1700.00],
            ['start_salary' => 15001.00, 'end_star' => 15500.00, 'allowance' => 1750.00],
            ['start_salary' => 15501.00, 'end_star' => 16000.00, 'allowance' => 1800.00],
            ['start_salary' => 16001.00, 'end_star' => 16500.00, 'allowance' => 1850.00],
            ['start_salary' => 16501.00, 'end_star' => 17000.00, 'allowance' => 1900.00],
            ['start_salary' => 17001.00, 'end_star' => 17500.00, 'allowance' => 1950.00],
            ['start_salary' => 17501.00, 'end_star' => 18000.00, 'allowance' => 2000.00],
            ['start_salary' => 18001.00, 'end_star' => 18500.00, 'allowance' => 2050.00],
            ['start_salary' => 18501.00, 'end_star' => 19000.00, 'allowance' => 2100.00],
            ['start_salary' => 19001.00, 'end_star' => 19500.00, 'allowance' => 2150.00],
            ['start_salary' => 19501.00, 'end_star' => 20000.00, 'allowance' => 2200.00],
            ['start_salary' => 20001.00, 'end_star' => 99999999.00, 'allowance' => 2250.00],
        ]);
    }
}
