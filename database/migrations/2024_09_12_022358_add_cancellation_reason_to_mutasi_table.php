<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancellationReasonToMutasiTable extends Migration
{
    public function up()
    {
        Schema::table('mutasi', function (Blueprint $table) {
            $table->text('cancellation_reason')->nullable()->after('verified_at');
        });
    }

    public function down()
    {
        Schema::table('mutasi', function (Blueprint $table) {
            $table->dropColumn('cancellation_reason');
        });
    }
}
