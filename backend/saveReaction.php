<?php
require_once('pdo.php');
if (isset($_POST['reaction']) && isset($_POST['date'])) {
  $reaction = $_POST['reaction'];
  $date = $_POST['date'];

  $sql = 'INSERT INTO reactions (reaction, date) VALUES(:reaction, :date)';
  $stmt = $pdo->prepare($sql);

  // Binding parameters
  $stmt->bindParam(':reaction', $reaction, PDO::PARAM_STR);
  $stmt->bindParam(':date', $date, PDO::PARAM_STR);

  // Request Execute
  if ($stmt->execute()) {
    header('Content-Type:application/json');
    echo json_encode('saved');
  } else {
    header('Content-Type:application/json');
    echo json_encode('Error');
  }
} else {
  header('Content-Type:application/json');
  echo json_encode('Error');
}
