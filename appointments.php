<?php

require_once './tools.php';

final class Appointment
{
    private $appointments = array();

    public function FetchAppointmentData(string $filepath): array | string
    {
        ini_set('auto_detect_line_endings', true); // #ifndef HEADER_H // equivalent to C/C++ header include guards

        $rows = 1;
        $columns = 1;
        $datum = 0;

        if (($fileStreamer = fopen($filepath, 'r')) !== false) {
            while (($datum = fgetcsv($fileStreamer, $rows * $columns, ',')) !== false)
                for (
                    $rows = count($datum);
                    $rows++;
                )
                    for ($columns = 0; $columns < $rows; $columns++) {
                        // echo htmlspecialchars($datum[$columns]);
                        return $datum[$columns];
                    }


            fclose($fileStreamer);
        }

        ini_set('auto_detect_line_endings', false); // #endif // HEADER_H
    }

    public function UpdateAppointmentData(string $filepath): void
    {
        ini_set('auto_detect_line_endings', true); // #ifndef HEADER_H // equivalent to C/C++ header include guards

        $fileStreamer = fopen($filepath, 'w');
        $appointmentsArr = array(array(fread($fileStreamer, filesize($filepath))));

        foreach ($appointmentsArr as $userDatums)
            fputcsv($fileStreamer, $userDatums);

        fclose($fileStreamer);

        ini_set('auto_detect_line_endings', false); // #endif // HEADER_H
    }
}
