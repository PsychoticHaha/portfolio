<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formToken = $_POST['token'] ?? '';
    $sessionToken = $_SESSION['token'] ?? '';

    if ($formToken && $sessionToken && hash_equals($sessionToken, $formToken)) {
        session_unset();
        session_destroy();
    }
}

header('Location: ./login.php');
exit;
