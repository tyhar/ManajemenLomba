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
            // $table->foreign('event_lomba_id')->references('id')->on('event_lombas');
            $table->foreignId('event_lomba_id')->constrained('event_lombas')->default(1);
            $table->string('name');
            $table->string('description');
            $table->string('kontak')->nullable();
            $table->string('pj')->nullable();
            $table->string('tempat')->nullable();
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
