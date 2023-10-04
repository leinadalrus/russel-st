<?php
include_once "./header.php";
?>

<script>
  $(function() {
    $(".portrait-image-carousel").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 5,
      centerMode: true,
      adaptiveHeight: true
    })
  })
</script>

<section>
  <article class="portrait-image-carousel">
    <div>
      <img src="https://images.unsplash.com/photo-1688590361364-2d153dac2a15?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTA3ODIwNTl8&ixlib=rb-4.0.3&q=85" alt="Royalty-free Stock image of a blue shaded subject" />
    </div>

    <div>
      <img src="https://images.unsplash.com/photo-1595878715977-2e8f8df18ea8?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTYyOTI3ODd8&ixlib=rb-4.0.3&q=85" alt="Royalty-free Stock image of a blue shaded subject" />
    </div>

    <div>
      <img src="https://images.unsplash.com/photo-1689500216081-e12c2580e0df?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTA3ODIyNzZ8&ixlib=rb-4.0.3&q=85" alt="Royalty-free Stock image of a blue shaded subject" />
    </div>

    <div>
      <img src="https://images.unsplash.com/photo-1483791424735-e9ad0209eea2?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTYyOTI3ODd8&ixlib=rb-4.0.3&q=85" alt="Royalty-free Stock image of a blue shaded subject" />
    </div>

    <div>
      <img src="https://images.unsplash.com/photo-1597116635010-8b65f0dce76c?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTYyOTI3ODd8&ixlib=rb-4.0.3&q=85" alt="Royalty-free Stock image of a blue shaded subject" />
    </div>

    <div>
      <img src="https://images.unsplash.com/photo-1563407844-11ca6f74f09a?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTYyOTI3ODd8&ixlib=rb-4.0.3&q=85" alt="Royalty-free Stock image of a blue shaded subject" />
    </div>
  </article>
</section>

<main class="main-container">

  <?php
  if (isset($_GET["signage"]))
    validate_remote_usage();
  else
    require_once "./login.php";

  if (isset($_SESSION["user"]))
    printf("<h1> Welcome %s </h1>", $_SESSION["user"]["id"]);

  if (!isset($_POST["password"])) {
    require "./administration.php";
  }
  ?>

  <h2>
    <b>About Us</b>
    <div id="about-us-graphic-banner"></div>
  </h2>
  <img id="staff-profile-cards" src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTA3ODczOTN8&ixlib=rb-4.0.3&q=85" />
  <article id="about-us-opening-line">
    <p>
      Russel Street Medical opened in 2020,
      <br />
      and is located in Melbourne"s CBD at:
      <br />
    <section id="about-us-details">
      <i>
        427 Swanston Street Melbourne 3000-
      </i>
      <br />
    </section>
    [...] -just opposite of RMIT University Building 10
    <br />
    and within walking distance of Melbourne Central Station.</p>

    <img id="sideskirting-hero-cover-image" src="imgs/daniel-surla-white-glint-fanart.png" alt="Cover image of a fan-art by Daniel Surla" />

  </article>

  <img id="staff-profile-cards" src="https://images.unsplash.com/photo-1631507623104-aa66944677aa?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTA3ODc1MjV8&ixlib=rb-4.0.3&q=85" alt="Image banner for the Staff Profile Cards" />

  <article id="about-us-closing-line">
    <p>We strive to help all of our patients with a focus on preventative healthcare,
    <section id="about-us-details">
      a view to managing chronic health conditions with a holistic approach, and with access to a wide range of
      specialist care providers when needed.
    </section>
    </p>

    <i>RMIT students and staff receive discounts through our partnership programs.</i>
  </article>

</main>

<table>
  <tr>
    <th>Consultation</th>
    <th>Normal Fee</th>
    <th>RMIT Member Fee</th>
    <th>Medicare Rebate</th>
  </tr>

  <tr>
    <td>Standard</td>
    <td>$80.00</td>
    <td>$60.00</td>
    <td>$40.00</td>
  </tr>
  <tr>
    <td>Long or Complex</td>
    <td>$125.00</td>
    <td>$95.00</td>
    <td>$75.00</td>
  </tr>
</table>

<span id="button-circle"></span>
<span id="button-circle"></span>

<div id="page-image-underlay"></div>

<section id="staff-profiles">
</section>
<h2><b>Who We Are</b>
  <div id="h2-graphic-banner"></div>
</h2>

<div class="staff-profiles-carousel">
  <span id="staff-profile-cards">
    <img id="stephen-image" src="imgs/pexels-tima-miroshnichenko-6234600.jpg" alt="Image of Dr. Stephen Hill" />

    <div id="breakline-separator"></div>

    <img id="kiyoko-image" src="imgs/pexels-pavel-danilyuk-8442283.jpg" alt="Photo of Kiyoko Tsu" />
  </span>

  <article id="staff-profile-details">

    <h4>Dr. Stephen Hill<div id="stephen-graphic-banner"></div>
    </h4>

    <table>
      <tr>
        <th>Stephen Hill graduated from Auckland University in New Zealand in 2014 and obtained his Fellowship
          from the Royal Australian College of General Practicioners in 2017.

      <tr>
        <td>

          Over his training and practice, Stephen worked in internal medicine at the Royal Children"s Hospital
          Melbourne before transitioning to General Practice.

        </td>
      </tr>
    </table>

    <h4>Ms. Kiyoko Tsu<div id="kiyoko-graphic-banner"></div>
    </h4>

    <table>

      <tr>
        <th>Kiyoko Tsu completed her Bachelor of Nursing at the Yong Loo Lin School of Medicine in Singapore in
          2019.
        </th>
      </tr>

      <tr>
        <td>
          She is an accredited Nurse Immunizer and has worked in various hospitals within metropolitan Melbourne.
        </td>
      </tr>
    </table>

  </article>

  <span id="button-circle"></span>
  <span id="button-circle"></span>
  <span id="button-circle"></span>
</div>

<?php
require_once "./footer.php";
?>