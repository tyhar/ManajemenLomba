<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegLombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_lombas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->unsignedBigInteger('team_member_id')->nullable();
            $table->unsignedBigInteger('submission_id')->nullable();
            $table->enum('status', ['belum dibaca', 'sudah dibaca'])->default('belum dibaca');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('team')->onDelete('set null');
            $table->foreign('team_member_id')->references('id')->on('team_members')->onDelete('set null');
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reg_lombas');
    }
}

