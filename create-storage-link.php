<?php

$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

// Remove existing link if exists
if (file_exists($link)) {
    if (is_link($link)) {
        unlink($link);
    } elseif (is_dir($link)) {
        rmdir($link);
    }
}

// Create junction/symlink
if (PHP_OS_FAMILY === 'Windows') {
    // Use junction for Windows
    exec("mklink /J \"$link\" \"$target\"", $output, $return);
    if ($return === 0) {
        echo "✓ Storage link created successfully!\n";
    } else {
        echo "✗ Failed to create storage link.\n";
        echo "Output: " . implode("\n", $output) . "\n";
        
        // Try alternative: copy files
        echo "\nTrying alternative method: copying files...\n";
        if (!file_exists($link)) {
            mkdir($link, 0755, true);
        }
        
        // Copy all files from storage/app/public to public/storage
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($target, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($files as $file) {
            $targetPath = $link . DIRECTORY_SEPARATOR . substr($file->getPathname(), strlen($target) + 1);
            if ($file->isDir()) {
                if (!file_exists($targetPath)) {
                    mkdir($targetPath, 0755, true);
                }
            } else {
                copy($file->getPathname(), $targetPath);
            }
        }
        echo "✓ Files copied successfully!\n";
    }
} else {
    symlink($target, $link);
    echo "✓ Storage link created successfully!\n";
}
