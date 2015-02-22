<?php

include_once '../resume.php';


if('GET' == $_SERVER['REQUEST_METHOD']) {
  doGet();
  exit;
} else {
  http_response_code(405);
  exit;
}

function doGet() {
  global $_GET;

  header('Content-Type: application/json');

  if(!isset($_GET["id"]) || empty($_GET["id"])) {
      http_response_code(400);
      echo json_encode(array("errors"=>array("id not specified")));
      exit;
  }

  $resume_id = $_GET["id"];

  $resume = resume_load($resume_id);

  if(empty($resume)) {
    http_response_code(404);
    exit;
  }

  echo json_encode($resume);
}

?>
