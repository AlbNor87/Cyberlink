<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

session_start();
session_destroy();

header("Location:/../../login.php");

// In this file we logout users.
