<?php
// Configuration file for shootingsports.in
// Store sensitive credentials in environment variables or a local .env file (not committed).

$env = [];
$envPath = __DIR__ . '/.env';
if (is_readable($envPath)) {
    $env = parse_ini_file($envPath);
}

$dbHost = $env['DB_HOST'] ?? getenv('DB_HOST') ?? '127.0.0.1';
$dbName = $env['DB_NAME'] ?? getenv('DB_NAME') ?? 'shootingsports';
$dbUser = $env['DB_USER'] ?? getenv('DB_USER') ?? 'root';
$dbPass = $env['DB_PASS'] ?? getenv('DB_PASS') ?? '';
$googleMapsApiKey = $env['GOOGLE_MAPS_API_KEY'] ?? getenv('GOOGLE_MAPS_API_KEY') ?? '';

/**
 * Returns a shared PDO instance with sane defaults.
 */
function getPdo(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    global $dbHost, $dbName, $dbUser, $dbPass;

    $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $dbHost, $dbName);
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
    return $pdo;
}
