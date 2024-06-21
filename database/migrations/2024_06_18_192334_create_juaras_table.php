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
        Schema::create('juaras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reg_lomba_id')->constrained('reg_lombas')->onDelete('cascade');
            $table->enum('juara', ['Juara 1', 'Juara 2', 'Juara 3', 'Juara Harapan 1' ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juaras');
    }
};
