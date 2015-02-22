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
$password = retrieveParameter("password", true);

if(!empty($errors)) {
  $return_code = 400;
}

if(empty($return_code)) {
  try {
    $result = user_authenticate($user_name, $password);
    if($result) {
      $return_code = 204;
    } else {
      $return_code = 401;
    }
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
