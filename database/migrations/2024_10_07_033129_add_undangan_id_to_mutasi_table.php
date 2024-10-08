<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUndanganIdToMutasiTable extends Migration
{
    public function up()
    {
        Schema::table('mutasi', function (Blueprint $table) {
            $table->unsignedBigInteger('undangan_id')->nullable()->after('user_id');

            // Menambahkan foreign key constraint
            $table->foreign('undangan_id')->references('id')->on('undangan')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('mutasi', function (Blueprint $table) {
            // Menghapus foreign key constraint jika ada
            $table->dropForeign(['undangan_id']);
            $table->dropColumn('undangan_id');
        });
    }
}
