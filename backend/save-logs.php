<?php
$logDirectory = __DIR__ . '/../logs';

if (!is_dir($logDirectory)) {
    mkdir($logDirectory, 0755, true);
}

$rawPayload = file_get_contents('php://input');
$decodedPayload = json_decode($rawPayload, true);

header('Content-Type: application/json');

if (!is_array($decodedPayload)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid payload.',
    ]);
    exit;
}

$timestamp = date('Ymd_His');
$filename = sprintf('%s/visitor_%s_%s.json', $logDirectory, $timestamp, uniqid());

file_put_contents($filename, json_encode($decodedPayload, JSON_PRETTY_PRINT));

echo json_encode([
    'status' => 'saved',
    'file' => basename($filename),
]);
