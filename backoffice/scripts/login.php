<?php
session_start();
$password = "$2y$10\$MA02Rkz/vBNVa3QOItTY6eJAcwRT4pmVQM0Y9llvAi8oKHNncI1vq";
$csrf = $_POST['csrf'];
$userpass = $_POST['pwd'];
if (isset($csrf) && $csrf == $_SESSION['csrf'] && isset($_POST['pwd']) && isset($_POST['login'])) {
  $_SESSION['count']++;
  if ($_SESSION['count'] >= 4) {
    header('Location:./../challenge.php');
  } else {
    if (password_verify($userpass, $password)) {
      $_SESSION['count'] = 1;
      $_SESSION['message'] = "<div class='alert success'>Welcome Fanasina !</div>";
      $_SESSION['token'] = generateToken();
      header('Location:./../dashboard.php');
    } else {
      $_SESSION['message'] = "<div class='alert error'>Error : Try again !</div>";
      header('Location:./../');
    }
  }
} else {
  $_SESSION['message'] = "<div class='alert error'>Error : Internal1 server failure !</div>";
  header('Location:./../');
}
function generateToken()
{
  $expirationTime = time() + (60 * 30); /* 30 minutes expiration */
  $token = bin2hex(random_bytes(32));
  $tokenWithExpiration = $token . '.' . $expirationTime;
  return $tokenWithExpiration;
}