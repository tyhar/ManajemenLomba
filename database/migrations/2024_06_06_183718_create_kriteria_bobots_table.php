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
        Schema::create('kriteria_bobots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bobot_id')->constrained('bobots');
            $table->foreignId('kriteria_id')->constrained('kriterias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_bobots');
    }
};
