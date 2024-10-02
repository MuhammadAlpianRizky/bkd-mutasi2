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
        Schema::create('persyaratan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_persyaratan')->unique();
            $table->string('nama_persyaratan');
            $table->string('jenis_file'); // jenis file yang diizinkan, contoh: "pdf", "jpeg"
            $table->integer('ukuran'); // Ukuran maksimum file dalam KB
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persyaratan');
    }
};
