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
       Schema::create('customer', function (Blueprint $table) {
    $table->string('customerId', 50)->primary();
    $table->string('customerName', 100)->nullable();
    $table->string('customerEmail', 50)->nullable();
    $table->string('customerPassword', 255)->nullable();
    $table->string('alamat', 100)->nullable();
    $table->string('customerNoTelp', 20)->nullable();
    $table->enum('customerJenisKelamin', ['Laki-laki', 'Perempuan'])->nullable();
    $table->string('avatar', 255)->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
