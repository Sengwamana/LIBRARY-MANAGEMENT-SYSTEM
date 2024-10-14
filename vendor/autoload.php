<?php
// autoload.php

/**
 * Custom Autoloader
 * This function will automatically load classes from the specified directories
 * when they are instantiated.
 */
spl_autoload_register(function ($class) {
    // Define the base directories for different components
    $baseDirs = [
        __DIR__ . '/../models/',       // Directory for model classes
        __DIR__ . '/../controllers/',  // Directory for controller classes
        __DIR__ . '/../middleware/',   // Directory for middleware classes
    ];

    // Loop through the base directories and check if the class exists
    foreach ($baseDirs as $baseDir) {
        $file = $baseDir . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
