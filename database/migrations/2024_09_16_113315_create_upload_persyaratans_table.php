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
        Schema::create('upload_persyaratan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mutasi_id');
            $table->unsignedBigInteger('persyaratan_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('kode_persyaratan');
            $table->string('file_path');
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('mutasi_id')->references('id')->on('mutasi')->onDelete('cascade');
            $table->foreign('persyaratan_id')->references('id')->on('persyaratan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload_persyaratan');
    }
};
