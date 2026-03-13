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
        Schema::create('detailPemesanan', function (Blueprint $table) {
    $table->string('detailPemesananId', 50)->primary();
    $table->string('pemesananId', 50)->nullable();
    $table->string('produkId', 5)->nullable();
    $table->integer('hargaSatuan')->nullable();
    $table->integer('qty')->default(1);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailPemesanan');
    }
};
