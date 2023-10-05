</body>

<footer>
  <p>Ph<i>:</i><i>03 63 83 83 AU NZ 18</i></p>
  <p>@<i>:</i><i>medical@Russel.St.com</i></p>
  <p>Daniel <i>David Sansano</i> Surla</p>
  <p>S<i>3729065</i></p>

  <!-- Bootstrap : 5.3 -->
  <!-- NOTE: CDN linkage aren't good & safe practices... -->
  <!-- ...use a package manager instead. -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

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