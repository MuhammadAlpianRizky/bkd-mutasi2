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
        // Migration file update
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('nip', 18)->unique();
    $table->string('nama_lengkap', 150);
    $table->string('alamat_tinggal', 255)->nullable();
    $table->string('no_hp', 13)->nullable();
    $table->string('email', 100)->unique()->nullable();
    $table->string('no_ktp', 25)->unique()->nullable();
    $table->string('no_karpeg', 25)->unique()->nullable();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('acc_on');  // Changed column name
    $table->string('photo_ktp')->nullable(); // Tambahkan kolom foto KTP
    $table->string('photo_karpeg')->nullable(); // Tambahkan kolom foto Karpeg
    $table->rememberToken();
    $table->timestamps();
});


        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 100)->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};