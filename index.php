<?php require_once __DIR__ . '/config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SenLogin</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="public/templates/TemplateVitrine/Logis/assets/img/favicon.png" rel="icon">
  <link href="public/templates/TemplateVitrine/Logis/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="public/templates/TemplateVitrine/Logis/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="public/templates/TemplateVitrine/Logis/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="public/templates/TemplateVitrine/Logis/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="public/templates/TemplateVitrine/Logis/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="public/templates/TemplateVitrine/Logis/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="public/templates/TemplateVitrine/Logis/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="public/templates/TemplateVitrine/Logis/assets/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

<!-- =========================== SECTION MENU ! ====================-->

  <?php require_once("view/sections/vitrine/menu.php"); ?>

  <main class="main">

    <!-- =========================== SECTION Banniere ! ====================-->
    <?php require_once("view/sections/vitrine/hero.php"); ?>

    <!-- =========================== SECTION Presentation Services ! ====================-->
    <?php require_once("view/sections/vitrine/featured-services.php"); ?>

    <!-- =========================== SECTION A PROPOS ! ====================-->
    <?php require_once("view/sections/vitrine/about.php"); ?>

    <!-- =========================== SECTION SERVICES ! ====================-->
    <?php require_once("view/sections/vitrine/services.php"); ?>

    <!-- =========================== SECTION CTA ! ====================-->
    <?php require_once("view/sections/vitrine/call-to-action.php"); ?>

    <!-- =========================== SECTION Fonctionnalités ! ====================-->
    <?php require_once("view/sections/vitrine/features.php"); ?>

    <!-- =========================== SECTION PRICING ====================-->
    <?php require_once("view/sections/vitrine/pricing.php"); ?>

    <!-- =========================== SECTION TEMOIGNAGES  ====================-->
    <?php require_once("view/sections/vitrine/testimonials.php"); ?>

    <!-- =========================== SECTION FAQ  ====================-->
    <?php require_once("view/sections/vitrine/faq.php"); ?>

  </main>

    <!-- =========================== FOOTER ====================-->
  <?php require_once("view/sections/vitrine/footer.php"); ?>

    <!-- =========================== SCRIPTS ====================-->
  <?php require_once("view/sections/vitrine/scripts.php"); ?>

</body>

</html>