<?php
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Method not allowed.',
    ]);
    exit;
}

$receivedToken = $_POST['token'] ?? '';
$storedToken = $_SESSION['token'] ?? '';

if (!verifyToken($receivedToken, $storedToken)) {
    http_response_code(403);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid or expired token.',
    ]);
    exit;
}

require_once __DIR__ . '/../../backend/pdo.php';

$queries = [
    'messages' => 'SELECT * FROM messages ORDER BY date DESC',
    'reactions' => 'SELECT * FROM reactions ORDER BY date DESC',
    'usage' => 'SELECT * FROM usage ORDER BY date DESC',
];

$payload = [];

foreach ($queries as $key => $sql) {
    try {
        $stmt = $pdo->query($sql);
        $payload[$key] = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    } catch (PDOException $exception) {
        $payload[$key] = [];
    }
}

echo json_encode([
    'status' => 'ok',
    'data' => $payload,
]);

function verifyToken($receivedToken, $storedToken)
{
    if (!$receivedToken || !$storedToken) {
        return false;
    }

    return hash_equals($storedToken, $receivedToken) && !isTokenExpired($receivedToken);
}

function isTokenExpired($token)
{
    $parts = explode('.', $token);
    $expirationTime = (int) end($parts);
    return $expirationTime < time();
}
