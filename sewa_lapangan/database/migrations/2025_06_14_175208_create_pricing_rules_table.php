<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pricing_rules', function (Blueprint $table) {
        $table->id();
        $table->foreignId('field_id')->constrained()->onDelete('cascade');
        $table->enum('day_type', ['weekday', 'weekend']);
        $table->enum('time_type', ['day', 'night']);
        $table->unsignedInteger('price_per_hour'); // Simpan sebagai integer (misal: 150000)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_rules');
    }
};
