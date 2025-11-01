<?php
require_once __DIR__ . '/../loadEnv.php';

$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbName = getenv('DB_NAME') ?: 'portfolio';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: 'portfolio_pass';

$dsn = sprintf('mysql:host=%s;port:3306;dbname=%s;charset=utf8mb4', $dbHost, $dbName);

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    die('Erreur de connexion : ' . $e->getMessage());
}
