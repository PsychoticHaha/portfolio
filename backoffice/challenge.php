<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/common.css">
  <link rel="stylesheet" href="./css/challenge.css">
  <title>RAF Challenge</title>
</head>

<body>
  <div class="title">
    <h2>Confirm your identity :</h2>
  </div>
  <form action="./scripts/verify-user.php" method="POST">
    <label for="hero">Your favorite superhero ?</label>
    <input type="password" id="hero" name="hero" class="response">
    <label for="nbr">Type a random number : </label>
    <input type="password" id="nbr" name="number" class="response">
    <label for="people">Your favorite person ?</label>
    <input type="password" id="people" name="person" class="response">
    <input type="submit" value="Check" id="check" name="submit">
  </form>
 </body>

</html>