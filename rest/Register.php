<?php

include_once '../user.php';
include_once '../support.php';

$errors = [];
$return_code = NULL;

function retrieveParameter($name, $required) {
  global $_POST, $errors;

  if(isset($_POST[$name]) && !empty($_POST[$name])) {
    return $_POST[$name];
  } else if($required) {
    $errors[] = "Missing required field: " . $name;
    return NULL;
  } else {
    return NULL;
  }
}

function correctRoles($roles) {
  global $errors;

  if(empty($roles)) {
    $roles = array();
  }

  $corrected_roles = [];

  foreach ($roles as $role) {
    if($role == 'type_user') {
      $corrected_roles[] = 'Candidate';
    } else if($role == 'type_emp') {
      $corrected_roles[] = 'Employer';
    } else {
      $errors[] = "Unexpected Role: " . $role;
    }
  }

  return $corrected_roles;
}

$user_name = retrieveParameter("user", true);
$password = retrieveParameter("pass", true);
$password_confirmation = retrieveParameter("con_pass", true);

$person = new stdClass;
$person->first_name = retrieveParameter("fname", true);
$person->middle_initial = retrieveParameter("m_init", true);
$person->last_name = retrieveParameter("lname", true);
$person->suffix = retrieveParameter("suffix", true);
$person->email = retrieveParameter("email", true);
$person->phone = retrieveParameter("phone", true);

$roles = retrieveParameter("user_type", true);
$roles = correctRoles($roles);

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
    $user_id = user_register($user_name, $password, $person, $roles);
    add_location_header("ViewUser.php?id=$user_id");
    $return_code = 201;
  } catch (Exception $e) {
    $errors[] = $e->getMessage();
    $return_code = 500;
    $user_id = NULL;
  }
}

if(!empty($errors)) {
  $data = array("errors"=>$errors);
} else {
  $data = array("user_id"=>$user_id);
}

header('Content-Type: application/json');
http_response_code($return_code);
if(!empty($data)) {
  echo json_encode($data);
}
?>
