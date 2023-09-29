<?php

final class AccessAttempt
{

    private $accessAttempts = array(0 => array(0));

    public function UpdateAccessAttempts(string $filepath)
    {
        $filepath = $_SERVER['DOCUMENT_ROOT'] . '/etc/' . 'accessattempts.txt';
        $username = verify_username_regex();

        $email = $_GET['email'] || $_POST['email'];
        $accessAttempted = array($username => array(0, $email, date(DATE_W3C)),);

        foreach ($this->accessAttempts as $attempt) {
            $this->accessAttempts[$attempt] = $accessAttempted;
        }

        fputcsv($filepath, $accessAttempted);
    }

    public function RetrieveAccessAttempts()
    {
        return $this->accessAttempts;
    }
}
