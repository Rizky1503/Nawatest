<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder{
    
    public function run(){
        DB::table('roles')->insert([
            'id_user' => 1,
            'id_role' => 1,
        ]);  

        DB::table('roles')->insert([
            'id_user' => 2,
            'id_role' => 2,
        ]);  
    }
}
