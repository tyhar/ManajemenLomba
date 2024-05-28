<?php

use App\Models\Kriteria;
use App\Models\Lomba;
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
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        //create pivot table for lomba and kriteria many to many relationship
        Schema::create('kriteria_lomba', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kriteria::class, 'kriteria_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Lomba::class, 'lomba_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
