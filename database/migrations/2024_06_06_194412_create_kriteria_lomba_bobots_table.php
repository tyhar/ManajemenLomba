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
        Schema::create('kriteria_lomba_bobots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_bobot_id')->constrained('kriteria_bobots');
            $table->foreignId('lomba_id')->constrained('lombas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_lomba_bobots');
    }
};
