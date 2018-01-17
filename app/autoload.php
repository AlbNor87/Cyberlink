<?php

declare(strict_types=1);

// Start the session engines.
session_start();

// Set the default timezone to Coordinated Universal Time.
date_default_timezone_set('UTC');

// Set the default character encoding to UTF-8.
mb_internal_encoding('UTF-8');

// Include the helper functions.
require __DIR__.'/functions.php';

// Fetch the global configuration array.
$config = require __DIR__.'/config.php';
$pdo = new PDO($config['database_path']);

//The following is for phpmyadmin:

// define('DB_HOST', "localhost");
// define('DB_NAME', "cyberlink");
// define('DB_USERNAME', "root");
// define('DB_PASSWORD', "root");

// Setup the database connection.
// $pdo = new PDO('mysql:host='.DB_HOST.'; dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
