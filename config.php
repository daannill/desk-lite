<?php

define('APP_NAME', $_ENV['APP_NAME'] ?? 'DeskLite');
define('APP_ENV', $_ENV['APP_ENV'] ?? 'production');
define('APP_URL', $_ENV['APP_URL'] ?? 'http://localhost/DeskLite');
define('APP_PATH', __DIR__);

define('DB_CONNECTION', $_ENV['DB_CONNECTION'] ?? 'sqlite');
define('DB_DATABASE', $_ENV['DB_DATABASE'] ?? 'database/database.sqlite');
define('DB_HOST', $_ENV['DB_HOST'] ?? '127.0.0.1');
define('DB_PORT', (int) ($_ENV['DB_PORT'] ?? 3306));
define('DB_USERNAME', $_ENV['DB_USERNAME'] ?? 'root');
define('DB_PASSWORD', $_ENV['DB_PASSWORD'] ?? '');

if (in_array(strtolower(APP_ENV), ['dev', 'development', 'local'], true)) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}