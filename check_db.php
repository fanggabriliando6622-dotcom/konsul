<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

$tableName = 'customer';
if (Schema::hasTable($tableName)) {
    $columns = Schema::getColumnListing($tableName);
    echo "Columns in '$tableName': " . implode(', ', $columns) . "\n";
} else {
    echo "Table '$tableName' does not exist.\n";
}
