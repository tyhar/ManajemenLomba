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
        Schema::create('kriteria_lombas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lomba_id')->constrained('lombas');
            $table->foreignId('kriteria_id')->constrained('kriterias');
            $table->decimal('bobot', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_lombas');
    }
};
