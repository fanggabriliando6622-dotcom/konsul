<?php
require __DIR__ . '/vendor/autoload.php';

$classes = [
    'Filament\Actions\EditAction',
    'Filament\Tables\Actions\EditAction',
    'Filament\Actions\DeleteBulkAction',
    'Filament\Tables\Actions\DeleteBulkAction',
    'Filament\Actions\BulkActionGroup',
    'Filament\Tables\Actions\BulkActionGroup',
];

foreach ($classes as $class) {
    if (class_exists($class)) {
        echo "$class exists\n";
    } else {
        echo "$class DOES NOT EXIST\n";
    }
}
