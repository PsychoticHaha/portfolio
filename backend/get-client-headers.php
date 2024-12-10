<?php

// URL de l'API "WhatIsMyBrowser"
$url = "https://api.whatismybrowser.com/api/v3/detect";
$api_key = ""; // Ajoute ici ta clé API

// Définir les headers pour activer les Client Hints
header("accept-ch: Sec-Ch-Ua,Sec-Ch-Ua-Full-Version,Sec-Ch-Ua-Platform,Sec-Ch-Ua-Platform-Version,Sec-Ch-Ua-Arch,Sec-Ch-Bitness,Sec-Ch-Ua-Model,Sec-Ch-Ua-Mobile,Device-Memory,Dpr,Viewport-Width,Downlink,Ect,Rtt,Save-Data,Sec-Ch-Prefers-Color-Scheme,Sec-Ch-Prefers-Reduced-Motion,Sec-Ch-Prefers-Contrast,Sec-Ch-Prefers-Reduced-Data,Sec-Ch-Forced-Colors");
header("critical-ch: Sec-Ch-Ua,Sec-Ch-Ua-Full-Version,Sec-Ch-Ua-Platform,Sec-Ch-Ua-Platform-Version,Sec-Ch-Ua-Arch,Sec-Ch-Bitness,Sec-Ch-Ua-Model,Sec-Ch-Ua-Mobile,Device-Memory,Dpr,Viewport-Width,Downlink,Ect,Rtt,Save-Data,Sec-Ch-Prefers-Color-Scheme,Sec-Ch-Prefers-Reduced-Motion,Sec-Ch-Prefers-Contrast,Sec-Ch-Prefers-Reduced-Data,Sec-Ch-Forced-Colors");

// Récupérer tous les headers HTTP reçus
$headers_list = [];
foreach (getallheaders() as $name => $value) {
    array_push($headers_list, array("name" => $name, "value" => $value));
}

// Configurer les headers pour la requête API
$headers = [
    'X-API-KEY: ' . $api_key,
];

// Préparer les données pour la requête API
$post_data = array(
    "headers" => $headers_list,
);

// Créer une requête cURL vers l'API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Envoyer la requête et récupérer la réponse
$result = curl_exec($ch);
curl_close($ch);

// Décoder la réponse JSON de l'API
$result_json = json_decode($result, true);
if ($result_json === null) {
    // Gérer une erreur éventuelle de l'API
    error_log("Erreur : Impossible de décoder la réponse JSON de l'API.");
    exit();
}

// Vérifier que l'API a renvoyé une réponse réussie
if ($result_json['result']['code'] !== "success") {
    // Gérer les erreurs de l'API
    error_log("Erreur API : " . $result_json['result']['message']);
    exit();
}

// Ajouter des métadonnées supplémentaires (IP du client, date)
$result_json['metadata'] = [
    'client_ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'timestamp' => date('Y-m-d H:i:s'),
];

// Endpoint personnel pour stocker les données
$personal_endpoint = "https://mon-backend-personnel.com/store-data";

// Envoyer la réponse JSON vers le backend personnel
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $personal_endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($result_json));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$response = curl_exec($ch);
curl_close($ch);

// Journaliser la réponse du backend personnel
if ($response === false) {
    error_log("Erreur : Impossible d'envoyer les données au backend personnel.");
} else {
    error_log("Données envoyées avec succès au backend personnel : " . $response);
}

// Aucune sortie vers le client
http_response_code(204); // Réponse HTTP vide (No Content)
