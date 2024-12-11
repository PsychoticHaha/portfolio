<?php
session_start();
$password = "$2y$10$\T4krFdzm8H0ELN8FqJx.AOWO1IsDhTBPVyQXMue3SXoRXbcCOJElC";
$csrf = $_POST['csrf'];
$userpass = $_POST['pwd'];

if (isset($csrf) && $csrf == $_SESSION['csrf'] && isset($_POST['pwd']) && isset($_POST['login'])) {
  if (password_verify($userpass, $password)) {
    $_SESSION['message'] = "<div class='alert success'>Welcome Fanasina !</div>";
    $_SESSION['token'] = generateToken();
    header('Location:./../dashboard.php');
  } else {
    $_SESSION['count'] += 1;
    $_SESSION['message'] = "<div class='alert error'>Error : Try again !</div>";

    sleep($_SESSION['count'] ** 2);
    header('Location:./../');
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