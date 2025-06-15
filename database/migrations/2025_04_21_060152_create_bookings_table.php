<?php

// database/migrations/xxxx_xx_xx_create_bookings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained()->onDelete('cascade');
            $table->foreignId('fields_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_booking');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('total_harga');
            $table->enum('status_pembayaran', ['pending', 'paid', 'canceled'])->default('pending');
            $table->enum('metode_pembayaran', ['transfer', 'cod'])->default('transfer');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

