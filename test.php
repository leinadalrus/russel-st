<?php

include_once './tools.php';
include_once './accessattempts.php';
include_once './appointments.php';
?>

<section>
    <article>
        <img class="portrait-image-carousel">
    </article>
</section>

<section class="service-section">
    <form method="get" action="misc/action.php" class="custom-form-container" onsubmit="processFormData()">
        <input type="email" id="email-field-style" name="email" onchange="validateEmailID()" />
        <input type="password" id="password-field-style" name="password" />

        <button type="submit" id="login-button-style" name="signage" formnovalidate>Sign In</button>
    </form>
</section>

<?php
if (isset($_GET['signage']))
    validate_remote_usage();

while (validate_remote_usage()) {
    include './administration.php';
}
?>

<script>
    $(function() {
        $('.portrait-image-carousel').slick()
    })
</script>

<script src="https://unpkg.com/htmx.org@1.9.6" integrity="sha384-FhXw7b6AlE/jyjlZH5iHa/tTe9EpJ1Y55RjcgPbjeWMskSxZt1v9qkxLJWNJaGni" crossorigin="anonymous"></script>

<?php
include_once './footer.php';
?>