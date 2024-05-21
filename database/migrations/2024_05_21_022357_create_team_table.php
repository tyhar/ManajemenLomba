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
        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->string('name_team')->nullable();
            $table->string('email')->unique();  // Menambahkan kolom email dan memberikan unique constraint
            $table->string('instansi')->nullable();  // Menambahkan kolom instansi
            $table->string('phone')->nullable(); // Menambahkan kolom phone
            $table->string('payment')->nullable();
            $table->enum('status', ['unverified', 'verified'])->default('unverified');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->string('certificate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team');
    }
};
