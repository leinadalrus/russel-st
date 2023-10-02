<?php

declare(strict_types=1);

include_once "./tools.php";

include_once "./header.php";
?>

<section class="service-section">
  <form class="custom-form-container" method="post" action="<?= $RootDirectory . "/misc/"; ?>action.php" onsubmit="processFormData()">
    <input id="patient-id-field" type="text" name="patient-id-field" value="Patient ID" onchange="validatePatientID()" required />

    <br />

    <input id="booking-date-field" type="datetime-local" name="booking-date" value="Booking Date" onfocus="mitigatePastDates()" required />

    <section class="booking-pills-container">

      <section class="pill-checkbox-section">
        <article id="pill-checkbox-article">
          <div>
            <input type="checkbox" name="pill-checkbox-selection" id="pill-checkbox-selector" name="pill-checkbox-selection" value="afternoon">
            <div id="pill-selection-tool"></div>
          </div>

          <label id="pill-label" for="morning">
            <img id="morning-booking-pill" src="imgs/two-pills-and-loving-morning.png" alt="" />
          </label>

        </article>
      </section>


      <section class="pill-checkbox-section">
        <article id="pill-checkbox-article">

          <div>
            <input type="checkbox" name="pill-checkbox-selection" id="pill-checkbox-selector" name="pill-checkbox-selection" value="afternoon">
            <div id="pill-selection-tool"></div>
          </div>

          <label id="pill-label" for="afternoon">
            <img id="afternoon-booking-pill" src="imgs/two-pills-and-loving-afternoon.png" alt="" />
          </label>


        </article>
      </section>


      <section class="pill-checkbox-section">
        <article id="pill-checkbox-article">

          <div>
            <input type="checkbox" name="pill-checkbox-selection" id="pill-checkbox-selector" name="pill-checkbox-selection" value="evening">
            <div id="pill-selection-tool"></div>
          </div>

          <label id="pill-label" for="evening">
            <img id="evening-booking-pill" src="imgs/two-pills-and-loving-night.png" alt="" />
          </label>


        </article>
      </section>

    </section>

    <label id="quote-reason-select" for="">Appointment Reason:</label>
    <select id="quote-reason-select" required>
      <option>Please Select</option>
      <option>Childhood Vaccination Shots</option>
      <option>Influenza Shot</option>
      <option>Covid Booster</option>
      <option>Blood Test</option>
    </select>

    <br />

    <input id="book-submit-button" type="submit" name="booking-pill-submission" value="Submit without Validation" formnovalidate />
  </form>
</section>

<?php
include_once "./footer.php";
?>