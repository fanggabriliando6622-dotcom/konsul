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
        Schema::create('formappointment', function (Blueprint $table) {
    $table->string('appointmentId', 5)->primary();
    $table->string('customerId', 50)->nullable();
    $table->string('dokterId', 50)->nullable();
    $table->date('date')->nullable();
    $table->time('time')->nullable();
    $table->char('pesan', 225)->nullable();
    $table->timestamp('created_at')->nullable();
    $table->timestamp('updated_at')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formappointment');
    }
};
