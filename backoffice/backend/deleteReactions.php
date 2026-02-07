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

$ids = parseIds($_POST['ids'] ?? null);

if (empty($ids)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'No reactions selected.',
    ]);
    exit;
}

try {
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("DELETE FROM reactions WHERE id IN ($placeholders)");
    foreach ($ids as $index => $id) {
        $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
    }
    $stmt->execute();

    echo json_encode([
        'status' => 'ok',
        'deleted' => $stmt->rowCount(),
    ]);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error.',
    ]);
}

function parseIds($raw)
{
    if (is_array($raw)) {
        $ids = $raw;
    } elseif (is_string($raw) && $raw !== '') {
        $decoded = json_decode($raw, true);
        if (is_array($decoded)) {
            $ids = $decoded;
        } else {
            $ids = preg_split('/\s*,\s*/', $raw);
        }
    } else {
        $ids = [];
    }

    $filtered = [];
    foreach ($ids as $id) {
        $value = filter_var($id, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1],
        ]);
        if ($value !== false) {
            $filtered[] = (int) $value;
        }
    }

    return array_values(array_unique($filtered));
}

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
