</body>

<footer>
  <p>Ph<i>:</i><i>03 63 83 83 AU NZ 18</i></p>
  <p>@<i>:</i><i>medical@Russel.St.com</i></p>
  <p>Daniel <i>David Sansano</i> Surla</p>
  <p>S<i>3729065</i></p>

  <link rel="stylesheet" href="css/app.css">
  <script src="js/app.js"></script>
  <!-- Slick Carousel: JQuery Plugin -->
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <?php
  if (!empty($_GET["q"])) {
    switch ($_GET["q"]) {
      case "info":
        phpinfo();
        exit;
        break;
    }
  }
  ?>
</footer>

</html>