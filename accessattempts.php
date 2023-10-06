<?php
function update_access_attempts(): void
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
