<?php

namespace Database\Seeders;

// Jangan lupa import Model Field
use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data Lapangan 1
        Field::create([
            'name' => 'Galaxy Futsal',
            'image' => 'https://images.unsplash.com/photo-1552667466-07770ae110d0?q=80&w=2070...',
            'address' => 'Jl. Raya Rungkut No. 10, Surabaya',
            'category' => 'Futsal',
            'description' => 'Lapangan futsal dengan rumput sintetis kualitas internasional dan fasilitas lengkap.',
            'open_time' => '08:00:00',
            'close_time' => '23:00:00',
            'status' => 'available',
        ]);

        // Data Lapangan 2
        Field::create([
            'name' => 'Champion Badminton Hall',
            'image' => 'https://images.unsplash.com/photo-1552667466-07770ae110d0?q=80&w=2070...',
            'address' => 'Jl. Dharmawangsa No. 112, Surabaya',
            'category' => 'Badminton',
            'description' => 'Tersedia 4 lapangan badminton dengan karpet standar dan pencahayaan yang terang.',
            'open_time' => '07:00:00',
            'close_time' => '22:00:00',
            'status' => 'available',
        ]);

        // Data Lapangan 3
        Field::create([
            'name' => 'Surabaya Basketball Court',
            'image' => 'https://images.unsplash.com/photo-1552667466-07770ae110d0?q=80&w=2070...',
            'address' => 'Jl. Kertajaya Indah Timur V, Surabaya',
            'category' => 'Basket',
            'description' => 'Lapangan basket outdoor dengan ring standar dan lantai beton yang mulus.',
            'open_time' => '06:00:00',
            'close_time' => '21:00:00',
            'status' => 'maintenance',
        ]);
    }
}