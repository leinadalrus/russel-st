<?php
require_once "./tools.php";
?>

<doctype! html>
    <html lang="en">

    <head>
        <title>Russel St. Medical</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="css/style.css" rel="stylesheet" />

        <!-- Add `slick.css` if you want styling -->
        <link rel="stylesheet" type="text/css" href="slick/slick.css" />
        <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />

        <!-- Add slick.js before your closing <body> tag, after jQuery (requires jQuery 1.7 +) -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7/dist/jquery.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <!-- Slick.js -->
        <script type="text/javascript" src="slick/slick.min.js"></script>
    </head>

    <header class="MainHeaderContainer">
        <img id="text-less-logo" src="imgs/two-pills-and-loving.png" alt="Text-less logo design by Daniel Surla">
    </header>
    <div id="header-banner"></div>

    <span id="temp-jumbotron-underlay"></span>

    <nav class="window-tabs">
        <a href="./index.php#welcome-title"><button id="home-solid-icon"></button>
        </a>

        <a href="./index.php#about-us-graphic-banner"><button id="manila-folder-tab-about"></button></a>

        <a href="./index.php#staff-profile-cards"><button id="manila-folder-tab-profiles"></button></a>

        <a href="./service.php#service-section"><button id="manila-folder-tab-services"></button></a>
    </nav>

    <body>