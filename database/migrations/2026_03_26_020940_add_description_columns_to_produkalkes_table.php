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
        Schema::table('produkALKES', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->after('gambar');
            $table->text('kegunaan')->nullable()->after('deskripsi');
            $table->string('dosis', 500)->nullable()->after('kegunaan');
            $table->text('efek_samping')->nullable()->after('dosis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produkALKES', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'kegunaan', 'dosis', 'efek_samping']);
        });
    }
};
