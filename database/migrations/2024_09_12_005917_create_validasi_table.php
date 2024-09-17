<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidasiTable extends Migration
{
    public function up()
    {
        Schema::create('validasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mutasi_id')->constrained()->onDelete('cascade');
            $table->boolean('sk_cpns_verified')->default(false);
            // other fields
            $table->timestamps();
        });
    }        
    public function down()
    {
        Schema::dropIfExists('validasi');
    }
}
