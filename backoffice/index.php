<?php
session_start();
if (!isset($_SESSION['message'])) $_SESSION['message'] = '';
if (!isset($_SESSION['count'])) $_SESSION['count'] = 1;
if($_SESSION['count'] >= 4)header('Location:./challenge.php');
$id = uniqid();
$_SESSION['csrf'] = $id;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/common.css">
  <link rel="stylesheet" href="./css/login.css">
  <title>Login</title>
</head>

<body>
  <div class="title">
    <h2>RAF Back-Office Platform</h2>
  </div>
  <form action="./scripts/login.php" method="POST">
    <?= $_SESSION['message']; ?>
    <input type="password" id="password" name="pwd" autofocus>
    <input type="submit" id="login" name="login" value="Login">
    <input type="hidden" value=<?= $id; ?> name="csrf">
    <? //var_dump($_SESSION['count']); ?>
  </form>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const alert = document.querySelector('.alert');
      setTimeout(() => {
        alert.remove();
      }, 2500);
    })
  </script>
</body>

</html>