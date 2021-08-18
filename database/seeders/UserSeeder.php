<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ]
        ]);
    }
}
