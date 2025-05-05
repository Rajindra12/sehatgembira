<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => 'Rajindra',
                'email' => 'jindra.aziz@gmail.com',
                'password' => Hash::make('q1w2e3r4'),
                'role' => 'user',
            ]);
        DB::table('users')->insert(
            [
                'name' => 'Jin',
                'email' => 'sunrisegedangan@gmail,com',
                'password' => Hash::make('q1w2e3r4'),
                'role' => 'admin',
            ]);
    }
}