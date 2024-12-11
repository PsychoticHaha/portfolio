<?php
// Identifiants pour l'authentification
$username = 'raf-admin';
$password = 'secret';

// Vérification de la présence des identifiants dans la requête
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || 
    $_SERVER['PHP_AUTH_USER'] !== $username || $_SERVER['PHP_AUTH_PW'] !== $password) {
    // Envoie d'un en-tête d'authentification si les identifiants sont manquants ou incorrects
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo '401 Unauthorized';
    exit;
}

header('Location:./login.php');
?>
