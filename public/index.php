<?php
declare(strict_types=1);

define('ROOT', dirname(__DIR__));

// Autoloader
require ROOT . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->safeLoad();

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set timezone
date_default_timezone_set('Europe/Moscow');

// Run application
\App\App::getInstance()->run();
