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
        Schema::create('pemesanan', function (Blueprint $table) {
    $table->string('pemesananId', 50)->primary();
    $table->string('customerId', 50)->nullable();
    $table->date('date')->nullable();
    $table->integer('totalPrice')->nullable();
    $table->string('nama_penerima', 100)->nullable();
    $table->string('no_telp_penerima', 20)->nullable();
    $table->text('alamat_pengiriman')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
