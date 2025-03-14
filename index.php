<?php 
require_once 'loadEnv.php';
// require 'backend/test-home.php';
// require 'backend/get-client-headers.php'; 
?>

<!doctype html>
<html lang=fr>
<?php require_once 'components/head-tag.php'; ?>
<link rel="stylesheet" href="./stylesheets/style.css">

<body class="dark" onload="">
  <div class="mouse-cursor"aria-hidden=true></div>
  <div class="theme-toggler"></div>
  <?php require_once 'components/loading-layer.php'; ?>
  <?php require_once 'components/top-scripts.php'; ?>
  <div class=bottom-info></div>
  <?php require_once 'components/navbar.php'; ?>
  <main>
    <?php require_once 'components/hero-section.php' ?>
    <?php require_once 'components/about-section.php' ?>
    <?php require_once 'components/why-us-section.php' ?>
    <?php require_once 'components/skills-section.php' ?>
    <?php require_once 'components/works-section.php' ?>
    <?php require_once 'components/contact-section.php' ?>
    <div class=socials>
      <div class=text>
        <div class=round></div>
        <p>Or contact me at one of the social networks below</p>
      </div>
    </div>
    <?php require_once 'components/footer.php' ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="./scripts/index.js" type="module"></script>
  <script src="./scripts/modules/isotope.js" type="module"></script>
</body>

</html>