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
        Schema::create('reg_lomba_team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reg_lomba_id')->constrained('reg_lombas')->onDelete('cascade');
            $table->foreignId('team_member_id')->constrained('team_members')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reg_lomba_team_members');
    }
};
