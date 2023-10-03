<?php

require_once "./tools.php";

final class Appointment
{
    public function FetchCommaSeparatedValues(string $filepath): array | false
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

    public function FetchAppointmentData(string $filepath): array | string
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

    public function UpdateAppointmentData(): void
    {
        $fileStreamer = fopen("etc/appointments.txt", "r+"); // make sure the text file exists
        // "r+" let's you read and overwrite strings
        flock($fileStreamer, LOCK_EX);

        $appointmentsArr = array(array(fread($fileStreamer, filesize("etc/appointments.txt"))));

        foreach ($appointmentsArr as $userDatums)
            fputcsv($fileStreamer, $userDatums);

        flock($fileStreamer, LOCK_UN);
        fclose($fileStreamer);
    }
}
