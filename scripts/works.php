<?php
$jsonFilePath = './scripts/JSON/works.json';
if (file_exists($jsonFilePath)) {
  $jsonContent = file_get_contents($jsonFilePath);
  $data = json_decode($jsonContent, true);
  if ($data !== null) {
    foreach ($data['works'] as $single_work) {
      $detailsBase = $single_work['details_link'] ?? '/project/';
      $workId = $single_work['id'] ?? '';
      $details_link = rtrim($detailsBase, '/') . '/' . $workId;

      $thumbnailPath = htmlspecialchars($single_work['thumbnail_path'] ?? '', ENT_QUOTES, 'UTF-8');
      $title = htmlspecialchars($single_work['title'] ?? 'Untitled project', ENT_QUOTES, 'UTF-8');
      $description = htmlspecialchars($single_work['description'] ?? '', ENT_QUOTES, 'UTF-8');
      $githubLink = htmlspecialchars($single_work['github_link'] ?? '#', ENT_QUOTES, 'UTF-8');
      $deployLink = htmlspecialchars($single_work['deployed_link'] ?? '#', ENT_QUOTES, 'UTF-8');
      $detailsHref = htmlspecialchars($details_link, ENT_QUOTES, 'UTF-8');

      echo '<div class="single-work cursor-set">
        <div class="thumbnail">';
      echo "<img src='' data-img=\"{$thumbnailPath}\" loading='lazy' alt=\"{$title}\" width='250'>";
      echo '</div>
        <div class="bottom">
          <h3 class="title">';
      echo $title;
      echo '</h3>
        <div class="description">';
      echo $description;
      echo '</div>
        <div class="techno-list">';
      $technologies = is_array($single_work['techno'] ?? null) ? $single_work['techno'] : [];
      foreach ($technologies as $single_techno) {
        $techno = htmlspecialchars($single_techno, ENT_QUOTES, 'UTF-8');
        echo '<div class="single-techno" translate="no">';
        echo $techno;
        echo '</div>';
      }
      echo "</div>";
      echo "<div class='links'>
          <a href=\"{$detailsHref}\" title='About this project' target='_blank' rel='noopener noreferrer'>About</a>
          <a href=\"{$githubLink}\" title='See on Github' class='github-link' target='_blank' rel='noopener noreferrer'>Code</a>
          <a href=\"{$deployLink}\" title='See project' class='deployed-link' target='_blank' rel='noopener noreferrer'></a>
        </div>
      </div>
      </div>";
    }
  } else {
    echo "ERROR WHEN CONVERTING JSON.";
  }
} else {
  echo "JSON file doesn't exist.";
}
