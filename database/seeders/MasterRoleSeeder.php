<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterRoleSeeder extends Seeder{
   
    public function run(){
        DB::table('master_roles')->insert([
            'name' => 'admin',
        ]);  

         DB::table('master_roles')->insert([
            'name' => 'guest',
        ]);  
    }
}
