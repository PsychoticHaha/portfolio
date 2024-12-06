<?php
session_start();
$receivedToken = $_POST['token'];
$storedToken = $_SESSION['token'];
header('Content-Type: application/json');
echo json_encode(($receivedToken));

if (verifyToken($receivedToken, $storedToken)) {
  require_once('/backend/pdo.php');
  $queryMsg = 'SELECT * FROM messages';
  $queryReactions = 'SELECT * FROM reactions';
  $queryUsage = 'SELECT * FROM usage';

  function fetchTableData($pdo, $query, $title)
  {
    $stmt = $pdo->query($query);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return [
      'title' => $title,
      'data' => $data,
    ];
  }

  $messages = fetchTableData($pdo, $queryMsg, 'messages');
  $reactions = fetchTableData($pdo, $queryReactions, 'reactions');
  $usage = fetchTableData($pdo, $queryUsage, 'usage');

  $result = [$messages, $reactions, $usage];
  $jsonResult = json_encode($result, JSON_PRETTY_PRINT);

  header('Content-Type: application/json');
  echo $jsonResult;
} else {
  // invalid Token, deny access
  // header('HTTP/1.1 403 Forbidden');
  header('Content-Type: application/json');
  echo json_encode('Token Error');
  exit();
}


function verifyToken($receivedToken, $storedToken)
{
  if ($receivedToken === $storedToken && !isTokenExpired($receivedToken)) {
    return true;
  }
  return false;
}

function isTokenExpired($token)
{
  $parts = explode('.', $token);
  $expirationTime = end($parts);
  // return (int) $expirationTime < time();
  return intval($expirationTime) < time();
}
