<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddValueTotalToRegLombaTable extends Migration
{
    public function up()
{
    Schema::table('reg_lombas', function (Blueprint $table) {
        $table->double('value_total')->default(0)->after('submission_id');
        $table->enum('status', ['belum_dinilai', 'sudah_dinilai'])->default('belum_dinilai')->after('value_total');
    });

    DB::unprepared('
        CREATE TRIGGER update_value_total AFTER INSERT ON `values`
        FOR EACH ROW
        BEGIN
            IF EXISTS (SELECT * FROM reg_lomba WHERE id = NEW.reg_lomba_id) THEN
                UPDATE reg_lomba
                SET value_total = value_total + NEW.value_count, updated_at = NOW()
                WHERE id = NEW.reg_lomba_id;
                
                -- Update the status to sudah_dinilai
                UPDATE reg_lomba
                SET status = "sudah_dinilai"
                WHERE id = NEW.reg_lomba_id AND value_total > 0;
            END IF;
        END
    ');
}

public function down()
{
    DB::unprepared('DROP TRIGGER IF EXISTS update_value_total');

    Schema::table('reg_lombas', function (Blueprint $table) {
        $table->dropColumn('value_total');
        $table->dropColumn('status');
    });
}

}
