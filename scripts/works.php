<?php
global $currentLanguage;

$jsonFilePath = './scripts/JSON/works.json';
if (file_exists($jsonFilePath)) {
  $jsonContent = file_get_contents($jsonFilePath);
  $data = json_decode($jsonContent, true);
  if ($data !== null) {
    $linkLabels = t('works.links');
    $linkLabels = is_array($linkLabels) ? $linkLabels : [];
    foreach ($data['works'] as $single_work) {
      $detailsBase = $single_work['details_link'] ?? '/project/';
      $workId = $single_work['id'] ?? '';
      $details_link = rtrim($detailsBase, '/') . '/' . $workId;

      $thumbnailPath = htmlspecialchars($single_work['thumbnail_path'] ?? '', ENT_QUOTES, 'UTF-8');

      $localizedTitle = $single_work['title_translations'][$currentLanguage] ?? null;
      $titleFallback = $single_work['title'] ?? 'Untitled project';
      $title = htmlspecialchars($localizedTitle ?: $titleFallback, ENT_QUOTES, 'UTF-8');

      $localizedDescription = $single_work['description_translations'][$currentLanguage] ?? null;
      $descriptionFallback = $single_work['description'] ?? '';
      $description = htmlspecialchars($localizedDescription ?: $descriptionFallback, ENT_QUOTES, 'UTF-8');

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
      $aboutText = htmlspecialchars($linkLabels['about'] ?? 'About', ENT_QUOTES, 'UTF-8');
      $codeText = htmlspecialchars($linkLabels['code'] ?? 'Code', ENT_QUOTES, 'UTF-8');
      $demoText = htmlspecialchars($linkLabels['demo'] ?? 'Demo', ENT_QUOTES, 'UTF-8');
      $aboutTitle = htmlspecialchars($linkLabels['aboutTitle'] ?? 'About this project', ENT_QUOTES, 'UTF-8');
      $codeTitle = htmlspecialchars($linkLabels['codeTitle'] ?? 'See on GitHub', ENT_QUOTES, 'UTF-8');
      $demoTitle = htmlspecialchars($linkLabels['demoTitle'] ?? 'See project', ENT_QUOTES, 'UTF-8');

      echo "<div class='links'>
          <a href=\"{$detailsHref}\" title=\"{$aboutTitle}\" target='_blank' rel='noopener noreferrer'>{$aboutText}</a>
          <a href=\"{$githubLink}\" title=\"{$codeTitle}\" class='github-link' target='_blank' rel='noopener noreferrer'>{$codeText}</a>
          <a href=\"{$deployLink}\" title=\"{$demoTitle}\" class='deployed-link' target='_blank' rel='noopener noreferrer'>{$demoText}</a>
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
