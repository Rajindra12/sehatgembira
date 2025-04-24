<?php

// database/migrations/xxxx_xx_xx_create_lapangans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lapangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('kategori');
            $table->integer('harga_per_jam');
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['Tersedia', 'Tidak Tersedia'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lapangans');
    }
};

