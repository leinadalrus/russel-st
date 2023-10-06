<?php

declare(strict_types=1);

// error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set("UTC");

$RootDirectory = $_SERVER["DOCUMENT_ROOT"];
//var $serverDomainName = $_SERVER["SERVER_NAME"];
$ServerDomainName = $_SERVER["HTTP_HOST"];

function logout_session(): void
{
    session_unset();
    // use the Garbage Collector first to prevent unwanted problems
    session_gc();
    // -with the session managment
    session_destroy();

    // next, return here - administration.html.php :=
    header($_SERVER["PHP_SELF"]);
}

function verify_username_regex(): string
{
    $id = $_SESSION["user"]["id"];

    if (!ctype_alnum($id) || !preg_match(
        "/^(?:[A-Z]{1,1}[a-z]{1,})$/",
        $id
    )) {
        logout_session();
    }

    return $id;
}

function validate_login_credentials(): string
{
    verify_username_regex();
    return respond_with_prerequisites();
}

function validate_remote_usage(): bool
{
    $fileReadRemoteUser = fopen("etc/users.txt", "r");
    flock($fileReadRemoteUser, LOCK_EX);

    if (!$fileReadRemoteUser) {
        logout_session();
    }

    while (!feof($fileReadRemoteUser)) {
        $readLineHandle = fgets($fileReadRemoteUser);
        return preg_match(verify_username_regex(), $readLineHandle);
    }

    flock($fileReadRemoteUser, LOCK_UN);
    fclose($fileReadRemoteUser);
}

function blowfish_hash_password(): bool
{
    if (!preg_match($_SESSION["user"]["password"], "/^(?:[A-Z]{2}[0-9]{1,})$/")) {
        printf("Error has occurred in user's session. Password has encountered an error [!?]");
        logout_session();
    }
    // $CurrentUser = hash_hmac("sha256", $FieldedEmail, $__S3729065_SECRET_FILE__);
    $hashedPassword = password_hash($_SESSION["user"]["password"], CRYPT_BLOWFISH, ["cost" => 12]);
    return password_verify($_SESSION["user"]["password"], $hashedPassword);
    // Attributions:
    // How can I store my users’ passwords safely?, https://stackoverflow.com/a/1581919.
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
        "http" => array(
            "method" => "POST",
            "content" => json_encode(var_dump($_POST)),
            "header" => "Content-Type: application/json\r\n" . "Accept: application/json\r\n"
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