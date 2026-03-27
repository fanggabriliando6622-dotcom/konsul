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
        Schema::table('customer', function (Blueprint $table) {
            if (Schema::hasColumn('customer', 'customerName')) {
                $table->renameColumn('customerName', 'name');
            }
            if (Schema::hasColumn('customer', 'customerEmail')) {
                $table->renameColumn('customerEmail', 'email');
            }
            if (Schema::hasColumn('customer', 'customerPassword')) {
                $table->renameColumn('customerPassword', 'password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->renameColumn('name', 'customerName');
            $table->renameColumn('email', 'customerEmail');
            $table->renameColumn('password', 'customerPassword');
        });
    }
};
