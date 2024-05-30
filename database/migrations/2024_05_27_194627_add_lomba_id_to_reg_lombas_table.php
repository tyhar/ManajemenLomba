<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLombaIdToRegLombasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_lombas', function (Blueprint $table) {
            $table->unsignedBigInteger('lomba_id')->nullable()->after('submission_id');

            // Foreign key constraint
            $table->foreign('lomba_id')->references('id')->on('lombas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_lombas', function (Blueprint $table) {
            $table->dropForeign(['lomba_id']);
            $table->dropColumn('lomba_id');
        });
    }
}
