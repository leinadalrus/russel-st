<?php

require_once "./tools.php";

function fetch_appointments(string $filepath): array | string
{
    $contents = array();
    // "r" places the cursor/marker at the start of the file"s content(s)
    $reader = fopen("etc/appointments.txt", "r"); // make sure the text file exists
    // "r" let"s just read file content(s)
    flock($reader, LOCK_EX);

    while (!feof($reader)) {
        $row = fgets($reader);
        $row = trim($row);
        $contents[] = $row;
    }

    flock($reader, LOCK_UN);
    fclose($reader);

    return $contents;
}

function update_appointments(): void
{
    if ($_POST["appoint"] == "appoint")
        update_appointments();
    else
        printf("<i>An error has occurred with the appointment submission</i>");

    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $username = $_POST["id"];

    $fileStreamer = fopen("etc/appointments.txt", "r+"); // make sure the text file exists
    // "r+" let"s you read and overwrite strings
    flock($fileStreamer, LOCK_EX);

    while (!feof($fileStreamer)) {
        $user_data = array($username, $lastname, $firstname, date(DATE_W3C));
        fputcsv($fileStreamer, $user_data, ",");
    }

    flock($fileStreamer, LOCK_UN);
    fclose($fileStreamer);
}

$fileStreamer = fopen("etc/appointments.txt", "r+");
flock($fileStreamer, LOCK_EX);

if (!count($_POST) > 0) {
    logout_session();
    header($_SERVER["PHP_SELF"]);
}

while (($readerCursor = fgetcsv($fileStreamer)) != false) {
    $denominator = explode(":", $readerCursor);

    if ($_SESSION["user"]["id"] != $denominator[0] && $_SESSION["user"]["password"] != $denominator[1]) {
        printf("<h6><i>An error occurred somewhere between your delimiter and denominator[!?]</i></h6>");
        logout_session();
    }

    while (!feof($fileStreamer)) {

        $appointmentsArr = array("appointment" => array("id", "firstname", "lastname", "datetime"));

        $appointmentsArr["appointment"]["id"] = $denominator[0];
        $appointmentsArr["appointment"]["firstname"] = $denominator[1];
        $appointmentsArr["appointment"]["lastname"] = $denominator[2];
        $appointmentsArr["appointment"]["datetime"] = $denominator[3];

        // if we wanna loop this return values into its own parent file:
        // header($_SERVER["PHP_SELF"]);
        // But since not...
        // ...we go we update an external persistent file
        update_appointments();
    }
}

flock($fileStreamer, LOCK_UN);
fclose($fileStreamer);
