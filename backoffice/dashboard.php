<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/common.css">
  <link rel="stylesheet" href="./css/dashboard.css">
  <title>RAF | Dashboard</title>
</head>

<body>
  <header>
    <div class="left">
      <div class="item message">Messages</div>
      <div class="item reactions">Reactions</div>
      <div class="item usage">Usage</div>
    </div>
    <div class="logout">
      <form action="logout.php" method="POST">
        <input type="submit" name="logout" value=".">
        <input type="hidden" value=<?= $_SESSION['token'] ?>>
      </form>
    </div>
  </header>
  <main>
    <div class="data-container">
      <!-- "id", 'fullname', 'email', 'message', 'is_read', 'date' -->
      <table id="message-container">
        <tr>
          <th>Email</th>
          <th>Message</th>
          <th>Date</th>
        </tr>
        <tr id="1">
          <td>fanasina.ramalandimanana@gmail.com</td>
          <td>Hello, I'm tryna to contact you for some...</td>
          <td>21-12-2023 13:46</td>
        </tr>
      </table>
    </div>
    <div style="height:1000vh; width:50px;background:red;"></div>
  </main>
  <script src="./scripts/load.js"></script>
</body>

</html>