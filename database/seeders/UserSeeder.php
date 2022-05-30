<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([

            
            [
                'id' => '1001',
                'name' => 'Sunday Kwaka',
                'email' => 'admin@oasisfootballscout.org',
                'otp' => 990900,
                'email_verified_at' => now(),
                'password' =>  Hash::make('admin2022'),
                'email_verified_at' => now(),
                'role' => 'admin',
                'usercode' => 'OASIS0000',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
            
                
                
          ]);
    }
}
