<?php
/**
 * Clear all CakePHP cache and ensure tmp/cache subfolders exist.
 *
 * Run from project root:
 *   php clear_cache.php
 *
 * Alternative (CakePHP CLI; clears configured engines only):
 *   php bin/cake.php cache clear_all
 */

$root = __DIR__;
$cacheDir = $root . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR . 'cache';
$subdirs = ['models', 'persistent', 'views'];

function removeDir(string $dir): void
{
    if (!is_dir($dir)) {
        return;
    }
    $items = @scandir($dir);
    if ($items === false) {
        return;
    }
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }
        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            removeDir($path);
        } else {
            @unlink($path);
        }
    }
    @rmdir($dir);
}

echo "Clearing CakePHP cache...\n";

removeDir($cacheDir);

if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
    echo "Created: tmp/cache\n";
}

foreach ($subdirs as $sub) {
    $path = $cacheDir . DIRECTORY_SEPARATOR . $sub;
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
        echo "Created: tmp/cache/{$sub}\n";
    }
}

echo "Done. Cache cleared and tmp/cache subfolders are ready.\n";
