<?php
require_once 'pdo.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request method.',
  ]);
  exit;
}

$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($fullname === '' || $email === '' || $message === '') {
  echo json_encode([
    'status' => 'error',
    'message' => 'Please fill out all fields before submitting the form.',
  ]);
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Please provide a valid email address.',
  ]);
  exit;
}

$secretKey = $_ENV['RECAPTCHA_SECRET_KEY'] ?? getenv('RECAPTCHA_SECRET_KEY') ?? '';
$recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
$recaptchaAction = $_POST['recaptcha_action'] ?? '';

if ($secretKey !== '') {
  if ($recaptchaResponse === '') {
    echo json_encode([
      'status' => 'error',
      'message' => 'reCAPTCHA verification failed. Please try again.',
    ]);
    exit;
  }

  $verification = verifyRecaptcha($secretKey, $recaptchaResponse, $_SERVER['REMOTE_ADDR'] ?? null);

  if (!is_array($verification) || ($verification['success'] ?? false) !== true) {
    echo json_encode([
      'status' => 'error',
      'message' => 'reCAPTCHA verification failed. Please try again.',
    ]);
    exit;
  }

  $score = $verification['score'] ?? 0;
  $action = $verification['action'] ?? '';

  if ($score < 0.5 || ($recaptchaAction && $action !== $recaptchaAction)) {
    echo json_encode([
      'status' => 'error',
      'message' => 'Your submission looks suspicious. Please try again.',
    ]);
    exit;
  }
}

try {
  $sql = 'INSERT INTO messages (fullname, email, message) VALUES (:fullname, :email, :message)';
  $stmt = $pdo->prepare($sql);

  $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':message', $message, PDO::PARAM_STR);

  $stmt->execute();

  echo json_encode([
    'status' => 'sent',
  ]);
} catch (Throwable $exception) {
  error_log('Contact form error: ' . $exception->getMessage());

  echo json_encode([
    'status' => 'error',
    'message' => 'Unable to send your message right now. Please try again later.',
  ]);
}

function verifyRecaptcha(string $secret, string $response, ?string $remoteIp = null): ?array
{
  $endpoint = 'https://www.google.com/recaptcha/api/siteverify';

  $payload = [
    'secret' => $secret,
    'response' => $response,
  ];

  if ($remoteIp) {
    $payload['remoteip'] = $remoteIp;
  }

  $ch = curl_init($endpoint);

  if ($ch === false) {
    return null;
  }

  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 5,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($payload),
  ]);

  $result = curl_exec($ch);

  if ($result === false) {
    curl_close($ch);
    return null;
  }

  curl_close($ch);

  return json_decode($result, true);
}
