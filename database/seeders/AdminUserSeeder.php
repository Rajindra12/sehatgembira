<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah user sudah ada
        $user = DB::table('users')->where('email', 'developer@developer.rayy')->first();
        
        if ($user) {
            // Update role jika user sudah ada
            DB::table('users')
                ->where('email', 'developer@developer.rayy')
                ->update(['role' => 'admin']);
                
            $this->command->info('User admin berhasil diperbarui.');
        } else {
            // Buat user baru jika belum ada
            User::create([
                'name' => 'dev',
                'email' => 'developer@developer.rayy',
                'password' => Hash::make('RasyaGans1@'),
                'role' => 'admin',
            ]);
            
            $this->command->info('User admin berhasil dibuat.');
        }
    }
}
