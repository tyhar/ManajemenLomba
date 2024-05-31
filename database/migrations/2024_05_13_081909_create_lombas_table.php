<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLombasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lombas', function (Blueprint $table) {
            $table->id();
            $table->string('name_lomba')->nullable();
            $table->string('description')->nullable();
            $table->string('kontak')->nullable();
            $table->string('pj')->nullable();
            $table->string('tempat')->nullable();
            $table->string('picture')->nullable();
            $table->string('sertifikat')->nullable();
            $table->decimal('biaya_pendaftaran', 10, 3)->nullable();
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
