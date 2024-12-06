<?php
session_start();

function set_session_variables()
{
  // Get current URL 
  $currentURL = $_SERVER['REQUEST_URI'];
  // Define Regex pattern
  $pattern = "/\/project\/(\d+)/";
  // Match Regex
  if (preg_match($pattern, $currentURL, $matches)) {
    // $matches[1] will contain extracted ID
    $projectID = $matches[1];
    $_SESSION['id'] = $projectID;

    // Start fetching json
    $jsonFilePath = '/scripts/JSON/works.json';
    if (file_exists($jsonFilePath)) {
      $jsonContent = file_get_contents($jsonFilePath);
      $data = json_decode($jsonContent, true);
      if ($data !== null) {
        foreach ($data['works'] as $single_work) {
          $name = $single_work['title'];
          $about = $single_work['about'];
          // Setting session variables for the actual project
          if ($projectID == $single_work['id']) {
            $_SESSION['name'] = $name;
            $_SESSION['about'] = $about;
            // DEFINE OTHER VARIABLES HERE
          }
        }
      } else {
        $_SESSION['info'] = "ERROR WHEN CONVERTING JSON.";
      }
    } else {
      $_SESSION['name'] = "JSON file doesn't exist.";
    }
     $_SESSION['url_id'] = "<h1>URL Project ID: " . $projectID . "</h1>";
  } else {
    $_SESSION['name'] = "";
    $_SESSION['about'] = "";
    require_once 'project-not-found.php';
  }
}
set_session_variables();



// Header XML pour le sitemap
header("Content-Type: application/xml; charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Génération des URL dynamiques
$projects = array(
    array('id' => 1, 'title' => 'Projet 1'),
    array('id' => 2, 'title' => 'Projet 2'),
    // Ajoutez d'autres projets depuis votre source de données
);

foreach ($projects as $project) {
    $projectUrl = 'https://www.votresite.com/project/' . $project['id']; // Générer l'URL dynamique
    echo '<url>';
    echo '<loc>' . $projectUrl . '</loc>';
    echo '<changefreq>monthly</changefreq>'; // Changer la fréquence selon vos besoins
    echo '<priority>0.8</priority>'; // Définir la priorité selon vos besoins
    echo '</url>';
}

echo '</urlset>';
?>
