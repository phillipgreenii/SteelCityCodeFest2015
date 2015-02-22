<?php

include_once '../user.php';

$errors = [];
$return_code = NULL;

function retrieveParameter($name, $required) {
  if(isset($_POST[$name])) {
    return $_POST[$name];
  } else if($required) {
    $errors[] = "Missing required field: " + $name;
    return NULL;
  } else {
    return NULL;
  }
}

$user_name = retrieveParameter("user", true);
$password = retrieveParameter("pass", true);
$password_confirmation = retrieveParameter("con_pass", true);

$person = new stdClass;
$person->first_name = retrieveParameter("fname", true);
$person->middle_initial = retrieveParameter("m_init", false);
$person->last_name = retrieveParameter("lname", true);
$person->suffix = retrieveParameter("suffix", false);
$person->email = retrieveParameter("email", true);
$person->phone = retrieveParameter("phone", false);


if(empty($errors) and ($password !== $password_confirmation)) {
  $errors[] = "Passwords don't match";
}

if(!user_available_user_name($user_name)) {
  $errors[] = "Username unavailable";
}

if(!empty($errors)) {
  $return_code = 400;
}

if(empty($return_code)) {
  try {
    $user_id = user_register($user_name, $password, $person);
    $return_code = 201;
  } catch (Exception $e) {
    $errors[] = $e->getMessage();
    $return_code = 500;
  }
}

if(!empty($errors)) {
  $data = json_encode(array("errors"=>$errors));
} else {
  $data = NULL;
}

header('Content-Type: application/json');
http_response_code($return_code);
if(!empty($data)) {
  echo json_encode($data);
}
?>
