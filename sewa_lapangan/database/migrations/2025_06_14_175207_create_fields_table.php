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
    Schema::create('fields', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('address');
        $table->string('category'); // misal: 'futsal', 'badminton'
        $table->text('description');
        $table->time('open_time');
        $table->time('close_time');
        $table->enum('status', ['available', 'maintenance', 'closed'])->default('available');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fields');
    }
};
