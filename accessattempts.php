<?php

final class AccessAttempt
{

    public function UpdateAccessAttempts(string $filepath): void
    {
        $filepath = 'etc/accessattempts.txt';
        $username = verify_username_regex();
        $accessAttempts = array();

        $email = $_GET['email'];
        $accessAttempted = array($username => array(0, $email, date(DATE_W3C)),);

        foreach ($accessAttempts as $attempt) {
            $accessAttempts[$attempt] = $accessAttempted;
        }

        fputcsv($filepath, $accessAttempted);
    }

    public function RetrieveAccessAttempts(string $filepath): array | false
    {
        return fgetcsv($filepath);
    }
}
