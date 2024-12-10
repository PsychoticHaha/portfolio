<?php 
// Exemple de stockage des informations dans un fichier
file_put_contents('logs/visitor_info.json', json_encode($result_json, JSON_PRETTY_PRINT), FILE_APPEND);
?>