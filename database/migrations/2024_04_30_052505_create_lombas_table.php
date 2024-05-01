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
        Schema::create('lombas', function (Blueprint $table) {
            $table->id();
            // $table->foreign('eventlomba_id')->references('id')->on('event');
            $table->foreignId('eventlomba_id')->constrained()->default(1);
            $table->string('name');
            $table->string('description');
            $table->string('kontak');
            $table->string('tempat');
            $table->string('picture')->nullable();
            $table->string('link_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lombas');
    }
};
