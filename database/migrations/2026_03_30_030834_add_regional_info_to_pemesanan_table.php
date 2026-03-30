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
        // Add regional info to customer table
        Schema::table('customer', function (Blueprint $table) {
            $table->string('provinsi', 100)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('desa', 100)->nullable();
            $table->string('kodepos', 10)->nullable();
            $table->text('detail_alamat')->nullable();
        });

        // Add regional info to pemesanan table
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->string('provinsi', 100)->nullable();
            $table->string('kota', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('desa', 100)->nullable();
            $table->string('kodepos', 10)->nullable();
            $table->text('detail_alamat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropColumn(['provinsi', 'kota', 'kecamatan', 'desa', 'kodepos', 'detail_alamat']);
        });

        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropColumn(['provinsi', 'kota', 'kecamatan', 'desa', 'kodepos', 'detail_alamat']);
        });
    }
};
