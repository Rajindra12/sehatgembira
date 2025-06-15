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
        // Cek apakah user sudah ada
        $user = DB::table('users')->where('email', 'tes123@gmail.com')->first();

        if ($user) {
            // Update role jika user sudah ada
            DB::table('users')
                ->where('email', 'tes123@gmail.com')
                ->update(['role' => 'user']);

            $this->command->info('User tes berhasil diperbarui.');
        } else {
            // Buat user baru jika belum ada
            User::create([
                'name' => 'tes',
                'email' => 'tes123@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ]);

            $this->command->info('User berhasil dibuat.');
        }
    }
}