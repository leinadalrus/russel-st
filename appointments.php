<?php

require_once "./tools.php";

function stream_appointments(string $filepath): array | false
{
    // ini_set("auto_detect_line_endings", true); // #ifndef HEADER_H // equivalent to C/C++ header include guards
    // NOTE: "auto_detect_line_endings" is deprecated

    $rows = 1;
    $columns = 1;

    if (($fileStreamer = fopen("etc/appointments.txt", "r")) !== false) {
        flock($fileStreamer, LOCK_EX);

        while (($datum = fgetcsv($fileStreamer)) !== false)
            for (
                $rows = count($datum);
                $rows++;
            ) {
                for ($columns = 0; $columns < $rows; $columns++) {
                    echo htmlspecialchars($datum[$columns]);
                    return $datum;
                }

                echo htmlspecialchars($datum[$rows]);
            }

        flock($fileStreamer, LOCK_UN);
        fclose($fileStreamer);
    }

    // ini_set("auto_detect_line_endings", false); // #endif // HEADER_H 
    // NOTE: "auto_detect_line_endings" is deprecated
}

function fetch_appointments(string $filepath): array | string
{
    $contents = array();
    // "r" places the cursor/marker at the start of the file's content(s)
    $reader = fopen("etc/appointments.txt", "r"); // make sure the text file exists
    // "r" let's just read file content(s)
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
    $fileStreamer = fopen("etc/appointments.txt", "r+"); // make sure the text file exists
    // "r+" let's you read and overwrite strings
    flock($fileStreamer, LOCK_EX);

    $appointmentsArr = array(array(fread($fileStreamer, filesize("etc/appointments.txt"))));

    foreach ($appointmentsArr as $userDatums) {
        $userDatums = array($_SESSION["appointment"]["id"], $_SESSION["appointment"]["firstname"], $_SESSION["appointment"]["lastname"], $_SESSION["appointment"]["datetime"] = date(DATE_W3C));
        fputcsv($fileStreamer, $userDatums);
    }

    flock($fileStreamer, LOCK_UN);
    fclose($fileStreamer);
}

$fileStreamer = fopen("etc/appointments.txt", "r+");
flock($fileStreamer, LOCK_EX);

$readerCursor = fgetcsv($fileStreamer);

if (!count($_POST) > 0) {
    logout_session();
    header($_SERVER["PHP_SELF"]);
}

foreach ($readerCursor as $row) {
    $denominator = explode(":", $row);

    if ($_POST['id'] != $denominator[0] && $_POST['password'] != $denominator[1]) {
        printf("An error occurred somewhere between your delimiter and denominator[!?]");
        logout_session();
    }

    $_SESSION['appointment']['id'] = $denominator[0];
    $_SESSION['appointment']['firstname'] = $denominator[2];
    $_SESSION['appointment']['lastname'] = $denominator[3];
    $_SESSION['appointment']['datetime'] = $denominator[4];

    update_appointments();

    header($_SERVER["PHP_SELF"]);
}

flock($fileStreamer, LOCK_UN);
fclose($fileStreamer);
