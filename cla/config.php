<?php
declare(strict_types=1);

// Keep local defaults for development; production deployments should provide environment variables.
$host = getenv('CLA_DB_HOST') ?: '127.0.0.1';
$user = getenv('CLA_DB_USER') ?: 'root';
$pass = getenv('CLA_DB_PASSWORD') ?: '';
$db = getenv('CLA_DB_NAME') ?: 'cla_db';
$port = (int) (getenv('CLA_DB_PORT') ?: 3306);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $pass, $db, $port);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    error_log($exception->getMessage());
    http_response_code(503);
    exit('The service is temporarily unavailable. Please try again later.');
}

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    ]);
    session_start();
}
?>