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
    $fileStreamer = fopen("etc/appointments.txt", "r+"); // make sure the text file exists
    // "r+" let"s you read and overwrite strings
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
