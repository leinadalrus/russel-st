<?php
if (!$_GET || !$_POST)
  printf('encountered an action method error');

if ($_GET || $_POST) {
  if (empty($_GET || $_POST))
    printf('Server has encountered an empty action method error [!?]');

  if (count($_GET) > 0 || count($_POST) > 0)
    printf('Server has encountered an empty action method error [!?]');
}

$getFormData = array(
  'http' => array(
    'method' => 'GET',
    'content' => json_encode($_GET['form']),
    'header' => 'Content-Type: application/json\r\n' . 'Accept: application/json\r\n'
  )
);

$postFormData = array(
  'http' => array(
    'method' => 'POST',
    'content' => json_encode($_POST['form']),
    'header' => 'Content-Type: application/json\r\n' . 'Accept: application/json\r\n'
  )
);

print_r($getFormData . '\n' . $postFormData);

$context = stream_context_create($formData);

$result = file_get_contents($_POST['form'], false, $context);

$response = json_decode($result);

print_r($context . '\n' . $result . '\n' . $response);

// Attribution(s):
// Send JSON POST request with PHP, 
// https://stackoverflow.com/a/14501952.
