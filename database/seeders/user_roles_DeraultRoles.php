<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user_roles_DeraultRoles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //User role types
        $roles = ['admin', 'staff', 'teacher'];

        for ($i = 0; $i < count($roles); $i++) { 
            DB::table('user_roles')->insert([
                'roleType' => $roles[$i]
            ]);
        }

        
    }
}
