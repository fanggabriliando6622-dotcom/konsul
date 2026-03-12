<?php

$dir = __DIR__ . '/app/Filament/Resources';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

foreach ($iterator as $file) {
    if ($file->isDir()) continue;
    
    $path = $file->getPathname();
    if (strpos($path, 'Table.php') !== false) {
        $content = file_get_contents($path);
        
        $newContent = str_replace(
            "use Filament\Tables\Actions\BulkActionGroup;",
            "use Filament\Actions\BulkActionGroup;",
            $content
        );
        $newContent = str_replace(
            "use Filament\Tables\Actions\DeleteBulkAction;",
            "use Filament\Actions\DeleteBulkAction;",
            $newContent
        );
        $newContent = str_replace(
            "use Filament\Tables\Actions\EditAction;",
            "use Filament\Actions\EditAction;",
            $newContent
        );
        
        if ($content !== $newContent) {
            file_put_contents($path, $newContent);
            echo "Reverted namespaces in $path\n";
        }
    }
}
echo "Done.\n";
