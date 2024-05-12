<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaValuesTable2 extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kriteria_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_id')->constrained()->onDelete('cascade');
            $table->string('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('kriteria_values');
    }
}
