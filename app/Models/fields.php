<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fields extends Model
{
    protected $table = "fields";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama',
        'alamat',
        'kategori',
        'harga_per_jam',
        'jam_buka',
        'jam_tutup',
        'gambar',
        'deskripsi',
        'status'
    ];
}
