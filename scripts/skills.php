<?php
$worksJSONpath = './scripts/JSON/skills.json';
if (file_exists($worksJSONpath)) {
  $worksList = file_get_contents($worksJSONpath);
  $datas = json_decode($worksList, true);
  if ($datas !== null) {
     foreach ($datas['categories'] as $category) {
      echo "<div class='category'>";
      echo "<h3 class='techno-category'>{$category['name']}</h3>";
      echo "<ul class='category-items'>";
      foreach ($category['items'] as $item) {
        echo "
      <li class='lang'>
        <img src='{$item['icon_path']}' loading='lazy' alt='{$item['name']}' title='{$item['name']}' width='50'>
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
