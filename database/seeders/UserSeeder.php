<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    public function run(){
        DB::table('users')->insert([
            'name' => 'dev',
            'email' => 'dev1@nawa.co.id',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);   

        DB::table('users')->insert([
            'name' => 'nawa',
            'email' => 'nawa@nawa.co.id',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);   
    }
}
