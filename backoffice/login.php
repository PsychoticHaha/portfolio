<?php
session_start();
if (!isset($_SESSION['message']))
  $_SESSION['message'] = '';
if (!isset($_SESSION['count']))
  $_SESSION['count'] = 1;
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
    <div class="alert-container">
      <?= $_SESSION['message']; ?>
    </div>
    <input type="text" id="username" placeholder="Username" autofocus>
    <input type="password" id="password" name="pwd" placeholder="Password">
    <div class="container">
      <input type="checkbox" id="checkbox" onclick="togglePwd()">
      <label for="checkbox">Show password</label>
    </div>
    <input type="submit" id="login" name="login" value="Login">
    <input type="hidden" value=<?= $id; ?> name="csrf">
  </form>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const alert = document.querySelector('.alert');

      if (alert) {
        setTimeout(() => {
          alert.remove();
        }, 2500);
      }
    })

    function togglePwd() {
      const pwdInput = document.querySelector('#password');

      if (pwdInput.type === 'password') {
        pwdInput.type = 'text';
      } else {
        pwdInput.type = 'password';
      }
    }
  </script>
</body>

</html>