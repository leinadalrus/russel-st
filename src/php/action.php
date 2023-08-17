<?php

function sanitise($input)
{
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);

  return $input;
}

function check()
{
  $err = "";

  if ($_SERVER["REQUEST_METHOD"] != "POST")
    $err = "error";

  return $err;
}

function prereq()
{
  $patient_id = $_POST['patient-id'];

  if ($_SERVER["REQUEST_METHOD"] == "POST")
    if (empty($_POST['patient-id']))
      $patient_id = "Patient ID has encountered: an error[!?]";

  $patient_id = sanitise($patient_id);
}

sanitise($_SERVER["PHP_SELF"]);

prereq();

check();
