<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // SALIN DAN TIMPA KODE INI KE DALAM FILE ...create_payments_table.php
    public function up(): void
    {
        // Pastikan nama tabelnya adalah 'payments'
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('amount');
            $table->string('payment_method');
            $table->string('status');
            $table->string('transaction_id_from_gateway')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
