<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER update_kode_persyaratan
            AFTER UPDATE ON persyaratan
            FOR EACH ROW
                UPDATE upload_persyaratan
                SET kode_persyaratan = NEW.kode_persyaratan
                WHERE kode_persyaratan = OLD.kode_persyaratan;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_kode_persyaratan');
    }
};
