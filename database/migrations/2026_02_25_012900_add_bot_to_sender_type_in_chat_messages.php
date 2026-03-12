<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Alter enum directly using raw SQL since doctrine/dbal might not support altering enum
        DB::statement("ALTER TABLE `chat_messages` MODIFY COLUMN `sender_type` ENUM('customer', 'dokter', 'bot') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the enum back. Note that if any 'bot' rows exist, this will cause an error unless they are updated or deleted first
        // It's safest to just delete any bot messages on downgrade
        DB::statement("DELETE FROM `chat_messages` WHERE `sender_type` = 'bot'");
        DB::statement("ALTER TABLE `chat_messages` MODIFY COLUMN `sender_type` ENUM('customer', 'dokter') NOT NULL");
    }
};
