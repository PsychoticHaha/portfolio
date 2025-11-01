<?php
require_once 'pdo.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Method not allowed.',
    ]);
    exit;
}

$message = trim($_POST['message'] ?? '');
$fullname = trim($_POST['fullname'] ?? 'Visitor Feedback');
$email = trim($_POST['email'] ?? 'feedback@raf.dev');

if (mb_strlen($message) < 3) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Feedback message is too short.',
    ]);
    exit;
}

try {
    $sql = 'INSERT INTO messages (fullname, email, message) VALUES (:fullname, :email, :message)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->execute();
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Unable to save feedback.',
    ]);
    exit;
}

echo json_encode([
    'status' => 'saved',
]);
