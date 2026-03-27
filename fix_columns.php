<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "Renaming customerName to name...\n";
    DB::statement("ALTER TABLE customer CHANGE customerName name VARCHAR(100)");
    echo "Renaming customerEmail to email...\n";
    DB::statement("ALTER TABLE customer CHANGE customerEmail email VARCHAR(50)");
    echo "Renaming customerPassword to password...\n";
    DB::statement("ALTER TABLE customer CHANGE customerPassword password VARCHAR(255)");
    echo "Successfully renamed columns.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
