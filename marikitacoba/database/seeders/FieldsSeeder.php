<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class fieldsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fields')->insert(
            [
                'nama' => 'Lapangan A',
                'alamat' => 'Jl. Contoh No.1',
                'kategori' => 'Futsal',
                'harga_per_jam' => 100000,
                'jam_buka' => '08:00:00',
                'jam_tutup' => '22:00:00',
                'gambar' => 'https://img.freepik.com/free-photo/view-soccer-gate-field_23-2150887566.jpg?t=st=1745735055~exp=1745738655~hmac=3fe8b833c8db41d8c36dc7d8db802a958f3c530d14752f09c66e5ec739b67b99&w=1800',
                'deskripsi' => 'Lapangan futsal yang nyaman dan luas.',
                'status' => 'Tersedia',
            ]
        );
        DB::table('fields')->insert(
            [
                'nama' => 'Lapangan B',
                'alamat' => 'Jl. Contoh No.2',
                'kategori' => 'Basket',
                'harga_per_jam' => 150000,
                'jam_buka' => '09:00:00',
                'jam_tutup' => '23:00:00',
                'gambar' => 'https://img.freepik.com/free-photo/man-practicing-basketball-near-hoop-outdoors-court_23-2147925208.jpg?t=st=1745735188~exp=1745738788~hmac=757e800cf96c56ec0d6ed9fff7d70019f446638544a3f6f13501aa379a8b2584&w=1800',
                'deskripsi' => 'Lapangan Bulu Tangkis Outdoor yang sejuk.',
                'status' => 'Tersedia',
            ]
        );
        DB::table('fields')->insert(
            [
                'nama' => 'Lapangan C',
                'alamat' => 'Jl. Contoh No.3',
                'kategori' => 'Badminton',
                'harga_per_jam' => 100000,
                'jam_buka' => '09:00:00',
                'jam_tutup' => '23:00:00',
                'gambar' => 'https://img.freepik.com/free-photo/badminton-concept-with-shuttlecock-racket_23-2149940893.jpg?t=st=1745735417~exp=1745739017~hmac=51b563ce0844c0c794bfdff524cee578af2e0702f6faa09b26c43520a2ad1816&w=1800',
                'deskripsi' => 'Lapangan Bulu Tangkis Outdoor yang sejuk.',
                'status' => 'Tersedia',
            ]
        );

        DB::table('fields')->insert(
            [
                'nama' => 'Lapangan D',
                'alamat' => 'Jl. Contoh No.4',
                'kategori' => 'Tennis',
                'harga_per_jam' => 200000,
                'jam_buka' => '07:00:00',
                'jam_tutup' => '21:00:00',
                'gambar' => 'https://img.freepik.com/free-photo/top-view-people-playing-paddle-tennis_23-2149434129.jpg?t=st=1745735077~exp=1745738677~hmac=6b688190dbb15635b3cc9efa318ec0306d615e77863c576c8ee465aff01d0fc7&w=1800',
                'deskripsi' => 'Lapangan Tennis Outdor.',
                'status' => 'Tersedia',
            ]
        );
    }
}
