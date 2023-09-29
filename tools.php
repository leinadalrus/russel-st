<?php

date_default_timezone_set('UTC');

$RootDirectory = $_SERVER['DOCUMENT_ROOT'];
//var $serverDomainName = $_SERVER['SERVER_NAME'];
$ServerDomainName = $_SERVER['HTTP_HOST'];

$CurrentUsers = update_current_users();

function update_current_users(): int | array
{
    $FieldedEmail = $_GET['email'] || $_POST['email'];
    $CurrentUser = $_SESSION['User'];

    $CurrentUsers = array(0 => array($CurrentUser, $FieldedEmail, date(DATE_W3C)));

    for ($iterator = 0; $iterator < sizeof($CurrentUsers); $iterator++) {
        $itemized = array($iterator => $CurrentUser, $FieldedEmail, date(DATE_W3C));
        $CurrentUsers[$iterator] = $itemized;
    }

    return $CurrentUsers;
}

function logout_session(): void
{
    session_unset();
    // use the Garbage Collector first to prevent unwanted problems
    session_gc();
    // -with the session managment
    session_destroy();

    // next, return here - administration.html.php :=
    header($_SERVER['PHP_SELF']);
    exit;
}

function verify_username_regex(): string
{
    $username = $_SESSION['user'];

    if (!ctype_alnum($username) || !preg_match(
        '/^(?:[A-Z]{2}[0-9]{1,})$/',
        $username
    )) {
        logout_session();
    }

    return $username;
}

function validate_login_credentials(): string
{
    verify_username_regex();
    return respond_with_prerequisites();
}

function validate_remote_usage(): bool
{
    $fileReadRemoteUser = fopen('etc/users.txt', 'r');

    if (!$fileReadRemoteUser) {
        logout_session();
    }

    while (!feof($fileReadRemoteUser)) {
        $readLineHandle = fgets($fileReadRemoteUser);
        return preg_match(verify_username_regex(), $readLineHandle);
    }

    fclose($fileReadRemoteUser);
}

function sanitise_input_field(string $input): string
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

function respond_with_prerequisites(): string
{
    $formData = array(
        'http' => array(
            'method' => 'POST',
            'content' => json_encode(var_dump($_POST)),
            'header' => "Content-Type: application/json\r\n" . "Accept: application/json\r\n"
        )
    );

    $context = stream_context_create($formData);
    $result = file_get_contents(sanitise_input_field($_SERVER["PHP_SELF"]), false, $context);
    $response = json_decode($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET")
        if (empty($_POST))
            "Server has encountered an error [!?]";

    $response = sanitise_input_field($response);

    return $response;
}

// Attribution(s):
// Send JSON POST request with PHP,
// https://stackoverflow.com/a/14501952.

// Authentication

session_start(['read_and_close' => 1]);

// $__S3729065_REALM__ = 'Canopy at Amstel Realm'; // test realm, commented out
$__S3729065_SECRET_FILE__ = hash_file('sha256', 'etc/secret.txt');
$CurrentUser = hash_hmac('sha256', $FieldedEmail, $__S3729065_SECRET_FILE__);

$hashedPassword = password_hash($AuthorizedPW, CRYPT_BLOWFISH);

// Temporary Cookies
$TemporaryCookie = array(0 => array('DS372', 'John Doe', date(DATE_W3C)));

foreach ($TemporaryCookie as $key => $value) {
    // Consider `explode()` to set one cookie into multiple arrays
    // Possibly akin to: explode($TemporaryCookie). May need revision
    explode(',', $key);

    $expirationTime = time() + 7200;
    setcookie($key, $value, time() + 7200, $_SESSION['User'], $SERVER['HTTP_HOST'], $TemporaryCookie[$key]);

    if (!isset($_COOKIE[$key])) {
        // delete cookie
        setcookie($key, $value, time() - 7200);
    }

    if ($expirationTime == time() + 7200)
        setcookie($key, $value, time() - 7200);
    // maybe `logout_session()` too?
}

session_commit();

header('Set-Cookie: $ServerDomainName=1; path=/; samesite=strict');

output_add_rewrite_var($ServerDomainName, $__S3729065_SECRET_FILE__);
// TODO(Daud): code ... Pattern Regular Expression Match of email against comparator and validator

if (!password_verify($AuthorizedPW, $hashedPassword)) {
    logout_session();
}

if (!isset($CurrentUser) || !isset($AuthorizedPW)) {
    header('WWW-Authenticate: Basic realm="$ServerDomainName"');
    header('HTTP/1.0 401 Unauthorized');

    // custom logout session function from './tools.php'
    logout_session();
}
