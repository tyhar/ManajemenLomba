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
        Schema::create('user_lombas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Menyesuaikan foreign key dengan tabel lombas
            $table->foreignId('lomba_id')->constrained('lombas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_lombas');
    }
};
