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
        Schema::create('kriteria_lombas_', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lomba_id')->constrained('lombas'); // Menyesuaikan foreign key dengan tabel lombas
            $table->foreignId('kriteria_id')->constrained('kriterias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_lombas_');
    }
};
