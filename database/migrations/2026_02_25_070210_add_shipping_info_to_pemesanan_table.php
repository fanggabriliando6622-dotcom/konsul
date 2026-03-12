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
        Schema::table('pemesanan', function (Blueprint $table) {
            if (!Schema::hasColumn('pemesanan', 'nama_penerima')) {
                $table->string('nama_penerima', 100)->nullable()->after('totalPrice');
            }
            if (!Schema::hasColumn('pemesanan', 'no_telp_penerima')) {
                $table->string('no_telp_penerima', 20)->nullable()->after('nama_penerima');
            }
            if (!Schema::hasColumn('pemesanan', 'alamat_pengiriman')) {
                $table->text('alamat_pengiriman')->nullable()->after('no_telp_penerima');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pemesanan', function (Blueprint $table) {
            $table->dropColumn(['nama_penerima', 'no_telp_penerima', 'alamat_pengiriman']);
        });
    }
};
