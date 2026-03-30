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
        // Tambah latitude & longitude ke tabel customer
        Schema::table('customer', function (Blueprint $table) {
            if (!Schema::hasColumn('customer', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('alamat');
            }
            if (!Schema::hasColumn('customer', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }
        });

        // Tambah latitude & longitude ke tabel pemesanan
        Schema::table('pemesanan', function (Blueprint $table) {
            if (!Schema::hasColumn('pemesanan', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('alamat_pengiriman');
            }
            if (!Schema::hasColumn('pemesanan', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });

        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude']);
        });
    }
};
