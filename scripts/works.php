<?php
$jsonFilePath = './scripts/JSON/works.json';
if (file_exists($jsonFilePath)) {
  $jsonContent = file_get_contents($jsonFilePath);
  $data = json_decode($jsonContent, true);
  if ($data !== null) {
    foreach ($data['works'] as $single_work) {
      $details_link = $single_work['details_link'].''.$single_work['id'];
echo '<div class="single-work">
        <div class="thumbnail">';
     echo "<img src='' data-img={$single_work['thumbnail_path']} loading='lazy' alt={$single_work['title']} width='250'>";
   echo'</div>
        <div class="bottom">
          <h3 class="title">';
            echo $single_work['title'];
         echo '</h3>
        <div class="description">';
          echo $single_work['description'];
        echo '</div>
        <div class="techno-list">';
          foreach ($single_work['techno'] as $single_techno) {
        echo '<div class="single-techno" translate="no">';
            echo $single_techno;    
        echo '</div>';
          }
  echo "</div>";
  echo "<div class='links'>
          <a href={$details_link} title='About this project' target='_blank'>About</a>
          <a href={$single_work['github_link']} title='See on Github' class='github-link'>Code</a>
          <a href={$single_work['deployed_link']} title='See project' class='deployed-link'></a>
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
