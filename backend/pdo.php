<?php
// DSN PRODUCTION
$dsn = 'mysql:host=sql105.infinityfree.com;dbname=if0_36018860_portfolio';
$username = 'if0_36018860';
$password = 'xaOIRfTFiy';

//PDO  Options connection
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
);

// Connection attempt
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

// DSN
// $dsn = 'mysql:host=localhost;dbname=portfolio';
// $username = 'root';
// $password = '';

// //PDO  Options connection
// $options = array(
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_EMULATE_PREPARES => false,
// );

// // Connection attempt
// try {
//     $pdo = new PDO($dsn, $username, $password, $options);
// } catch (PDOException $e) {
//     die('Erreur de connexion : ' . $e->getMessage());
// }
