<?php
include_once "./tools.php";
// Authentication

// session_start(["read_and_close" => 1]);
session_start();

// $__S3729065_REALM__ = "Canopy at Amstel Realm"; // test realm, commented out
$__S3729065_SECRET_FILE__ = hash_file("sha256", "etc/secret.txt");

// Temporary Cookies
// $TemporaryCookies = array(0 => array("Stephen", date(DATE_W3C)));

// foreach ($TemporaryCookie as $key => $value) {
//     // Consider `explode()` to set one cookie into multiple arrays
//     // Possibly akin to: explode($TemporaryCookie). May need revision
//     explode(",", $key);

//     $expirationTime = time() + 7200;
//     setcookie($key, $value, time() + 7200, $_SESSION["User"], $SERVER["HTTP_HOST"], $TemporaryCookie[$key]);

//     if (!isset($_COOKIE[$key])) {
//         // delete cookie
//         setcookie($key, $value, time() - 7200);
//     }

//     if ($expirationTime == time() + 7200)
//         setcookie($key, $value, time() - 7200);
//     // maybe `logout_session()` too?
// }

session_commit();

header("Set-Cookie: $ServerDomainName=1; path=/; samesite=strict");

output_add_rewrite_var($ServerDomainName, $__S3729065_SECRET_FILE__);
// TODO(Daud): code ... Pattern Regular Expression Match of email against comparator and validator

// if (!password_verify($AuthorizedPW, $hashedPassword)) {
//     logout_session();
// }

// if (!isset($CurrentUser) || !isset($AuthorizedPW)) {
//     header("WWW-Authenticate: Basic realm="$ServerDomainName"");
//     header("HTTP/1.0 401 Unauthorized");

//     // custom logout session function from "./tools.php"
//     logout_session();
// }

$fileStreamer = fopen("etc/users.txt", "r");
$readerCursor = fgetcsv($fileStreamer);

if (!count($_POST) > 0) {
  // logout_session();
  header($_SERVER["PHP_SELF"]);
} else {
  update_access_attempts("etc/accessattempts.txt");
}

foreach ($readerCursor as $row) {
  $denominator = explode(":", $row);

  if ($_POST['id'] != $denominator[0] && $_POST['password'] != $denominator[1]) {
    printf("<h6><i>Sign-in for greater permissions!<i></h6>");
    logout_session();
  }

  $_SESSION['user']['id'] = $denominator[0];
  $_SESSION['user']['password'] = $denominator[1];

  header($_SERVER["PHP_SELF"]);
}

fclose($fileStreamer);
?>

<aside>
  <section class="login-section">
    <form method="get" action="misc/action.php" class="custom-form-container" onsubmit="processFormData()">
      <input type="email" id="email-field-style" name="email" onchange="validateEmailID()" />
      <input type="password" id="password-field-style" name="password" />

      <button type="submit" id="login-button-style" name="signage" formnovalidate>Sign In</button>
    </form>
  </section>
</aside>

<style>
  .login-section {
    transform: translate(-14.704rem, 0);
    max-width: 15.704rem;
    max-height: fit-content;

    position: relative;
    display: grid;

    padding: 1rem;
    margin-right: 33%;
    margin-left: 42%;
    margin-top: 20%;

    border: 0.063rem solid #ecf1f2;
    border-radius: 1.5rem;
    padding: 2.704rem;
  }

  .custom-form-container {
    display: inline-flex;
    flex-direction: column;

    justify-content: center;
    align-items: center;

    line-height: 1.126rem;
    gap: 0.704rem;
  }

  #email-field-style {
    padding: 1rem;
  }

  #password-field-style {
    padding: 1rem;
  }

  input {
    border-top: none !important;
    border-right: none !important;
    border-left: none !important;
    border-bottom: solid #0af;
  }

  select {
    border-top: none !important;
    border-right: solid #0af;
    border-left: none !important;
    border-bottom: none !important;
  }

  #login-button-style {
    transform: translate(10.704rem, 0);
    background-color: crimson;

    border-top: none !important;
    border-right: none !important;
    border-left: none !important;

    border-bottom: none !important;
    border-bottom-right-radius: 0.5rem;
    border-bottom-left-radius: 0.2rem;

    width: 17.256rem;
    height: 2.6rem;
    max-height: 2.2rem;

    padding-bottom: 1.15%;
    padding: 0.3rem;
    margin: 0.1rem;
    position: relative;

    text-align: justify;
    text-align-last: end;

    opacity: 80%;
    color: white;
  }

  input:invalid {
    border-bottom: 0.1rem dashed crimson;
  }
</style>