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
        Schema::create('pembayaran', function (Blueprint $table) {
    $table->string('pembayaranId', 50)->primary();
    $table->string('customerId', 50)->nullable();
    $table->string('pemesananId', 50)->nullable();
    $table->string('chatDokterId', 50)->nullable();
    $table->integer('amount')->nullable();
    $table->char('metodePembayaran', 100)->nullable();
    $table->date('date')->nullable();
    $table->char('status', 50)->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
