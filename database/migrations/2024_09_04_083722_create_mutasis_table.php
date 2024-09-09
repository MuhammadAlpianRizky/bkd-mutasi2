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
        Schema::create('mutasi', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi')->nullable()->unique();
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('pgol')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('instansi')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('sk_cpns')->nullable();
            $table->string('sk_pns')->nullable();
            $table->string('sk_pangkat_terakhir')->nullable();
            $table->string('sk_jabatan_struktural')->nullable();
            $table->string('sk_jabatan_fungsional')->nullable();
            $table->boolean('is_final')->default(false);
            $table->boolean('verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi');
    }
};
