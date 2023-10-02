<?php

require_once "./tools.php";

final class Appointment
{
    private $appointments = array();

    public function FetchCommaSeparatedValues(string $filepath)
    {
        // ini_set("auto_detect_line_endings", true); // #ifndef HEADER_H // equivalent to C/C++ header include guards
        // NOTE: "auto_detect_line_endings" is deprecated

        $rows = 1;
        $columns = 1;

        if (($fileStreamer = fopen($filepath, "r")) !== false) {
            while (($datum = fgetcsv($fileStreamer, $rows * $columns, ",")) !== false)
                for (
                    $rows = count($datum);
                    $rows++;
                )
                    for ($columns = 0; $columns < $rows; $columns++) {
                        echo htmlspecialchars($datum[$columns]);
                    }

            return $fileStreamer;

            fclose($fileStreamer);
        }

        // ini_set("auto_detect_line_endings", false); // #endif // HEADER_H 
        // NOTE: "auto_detect_line_endings" is deprecated
    }

    public function FetchAppointmentData(string $filepath): array | string
    {
        $contents = array();
        $reader = fopen("etc/accessattempts.txt", "r");

        while (!feof($reader)) {
            $row = fgets($reader);
            $row = trim($row);
            $contents[] = $row;
        }
        fclose($reader);

        return $contents;
    }

    public function UpdateAppointmentData(string $filepath): void
    {
        ini_set("auto_detect_line_endings", true); // #ifndef HEADER_H // equivalent to C/C++ header include guards

        $fileStreamer = fopen($filepath, "w");
        $appointmentsArr = array(array(fread($fileStreamer, filesize($filepath))));

        foreach ($appointmentsArr as $userDatums)
            fputcsv($fileStreamer, $userDatums);

        fclose($fileStreamer);

        ini_set("auto_detect_line_endings", false); // #endif // HEADER_H
    }
}
