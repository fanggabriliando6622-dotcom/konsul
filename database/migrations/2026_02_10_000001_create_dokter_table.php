<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->string('dokterId', 50)->primary();
            $table->string('dokterName', 100)->nullable();
            $table->char('namaBidang', 50)->nullable();
            $table->integer('dokterAge')->nullable();
            $table->enum('jenisKelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('gambar', 255)->nullable();
            $table->enum('statusDokter', ['online', 'offline', 'sibuk', 'tersedia'])->default('online');
            $table->timestamp('jadwalPraktik')->nullable();
            $table->integer('hargaKonsultasi')->default(0);
            $table->string('adminid', 5)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};