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
       Schema::create('kategoriALKES', function (Blueprint $table) {
    $table->string('kategoriId', 5)->primary();
    $table->char('kategoriName', 50)->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoriALKES');
    }
};
