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
        Schema::create('produkALKES', function (Blueprint $table) {
    $table->string('produkId', 5)->primary();
    $table->char('produkName', 100)->nullable();
    $table->integer('price')->nullable();
    $table->integer('qty')->nullable();
    $table->string('gambar', 255)->nullable();
    $table->string('kategoriId', 5)->nullable();
    $table->string('adminId', 5)->nullable();
    $table->date('Tanggal_Kadaluwarsa')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produkALKES');
    }
};
