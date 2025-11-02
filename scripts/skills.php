<?php
$worksJSONpath = './scripts/JSON/skills.json';
if (file_exists($worksJSONpath)) {
  $worksList = file_get_contents($worksJSONpath);
  $datas = json_decode($worksList, true);
  if ($datas !== null) {
    foreach ($datas['categories'] as $category) {
      $categoryKey = $category['key'] ?? null;
      $fallbackName = $category['name'] ?? '';
      $categoryLabel = $categoryKey ? t('skills.categories.' . $categoryKey, $fallbackName) : $fallbackName;
      echo "<div class='category'>";
      echo "<h3 class='techno-category'>" . htmlspecialchars($categoryLabel, ENT_QUOTES, 'UTF-8') . "</h3>";
      echo "<ul class='category-items'>";
      foreach ($category['items'] as $item) {
        echo "
      <li class='lang cursor-set'>
        <div class='img-container'>
          <img src='' data-img='{$item['icon_path']}' data-loading='lazy' alt='{$item['name']}' title='{$item['name']}'>
        </div>
        <div class='lang-name' translate='no'>
          {$item['name']}
        </div>
      </li>";
      }
      echo "</ul></div>";
    }
  } else {
    echo "Erreur lors de la conversion du JSON.";
  }
} else {
  echo "Le fichier JSON n'existe pas.";
}
