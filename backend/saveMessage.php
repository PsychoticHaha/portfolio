<?php
require_once('pdo.php');
if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['message'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $sql = "INSERT INTO messages (fullname, email, message) VALUES (:fullname, :email, :message)";
  $stmt = $pdo->prepare($sql);

  // Binding parameters
  $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':message', $message, PDO::PARAM_STR);

  // Request Execute
  if ($stmt->execute()) {
    header('Content-Type:application/json');
    echo json_encode('sent');
  } else {
    header('Content-Type:application/json');
    echo json_encode('Error');
  }
} else {
  header('Content-Type:application/json');
  echo json_encode('Error');
}
