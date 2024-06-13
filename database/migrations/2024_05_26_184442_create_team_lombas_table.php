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
        Schema::create('team_lombas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lomba_id')->constrained('lombas')->onDelete('cascade'); // Add cascade on delete
            $table->foreignId('team_id')->constrained('team')->onDelete('cascade');   // Add cascade on delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_lombas');
    }
};
