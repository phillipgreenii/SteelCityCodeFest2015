<?php

include_once '../resume.php';
include_once '../user.php';
include_once '../support.php';


if('GET' == $_SERVER['REQUEST_METHOD']) {
  doGet();
  exit;
} elseif('POST' == $_SERVER['REQUEST_METHOD']) {
  doPost();
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

function doPost() {
  global $_POST;

  $errors = [];
  $return_code = NULL;

  if(!user_is_candidate()) {
    $errors[] = "User must be a candidated to create a resume.";
    $return_code = 403;
  }

  $resume = _build_resume($errors, $_POST);

  if(!empty($errors)) {
    $return_code = 400;
  }

  if(empty($return_code)) {
    try {
      $user_id = user_retrieve_current_id();
      $newly_created_resume_id = resume_save($user_id, $resume);

      if($newly_created_resume_id !== NULL) {
        add_location_header("../ViewResume.php?id=$newly_created_resume_id");
        $return_code = 201;
      } else {
        $return_code = 204;
      }
    } catch (Exception $e) {
      $errors[] = $e->getMessage();
      $return_code = 500;
      $user_id = NULL;
    }
  }

  if(!empty($errors)) {
    $data = array("errors"=>$errors);
  } else {
    $data = NULL;
  }

  header('Content-Type: application/json');
  http_response_code($return_code);
  if(!empty($data)) {
    echo json_encode($data);
  }
}


function _build_resume(&$errors, $data) {

   $retrieveParameter = function ($data, $name, $required = false, $defaultValue = NULL) use (&$errors) {
      if(isset($data[$name]) && !empty($data[$name])) {
        return $data[$name];
      } else if($required) {
        $errors[] = "Missing required field: " . $name;
        return $defaultValue;
      } else {
        return $defaultValue;
      }
    };

    $convertToDate = function ($name, $value)  use (&$errors) {
      if($value === NULL) {
        return NULL;
      }
      $date = strtotime($value);
      if($date === false) {
        $errors[] = "Invalid date field: " . $name;
        return NULL;
      }

      return $date;
    };

    $resume = new stdClass;
    $resume->introduction = $retrieveParameter($data, 'intro', false);
    #FIXME front-end has multiple key_points, but db only has one, make consistent
    $kp = $retrieveParameter($data, 'kp', false, []);
    $resume->key_points = implode (", ", $kp);

    #experiences
    $resume->experiences = [];
    foreach ($retrieveParameter($data, 'experience', false, []) as $experience_input) {
      $experience = new stdClass;
      $experience->title = $retrieveParameter($experience_input, 'title', true);
      $experience->company = $retrieveParameter($experience_input, 'company', true);
      $sd = $retrieveParameter($experience_input, 'startdate', true);
      $experience->start_date = $convertToDate('startdate', $sd);
      $ed = $retrieveParameter($experience_input, 'enddate', false);
      $experience->end_date =  $convertToDate('enddate', $ed);
      #FIXME front-end has multiple responsibilities, but db only has one description, make consistent
      $responsibilities = $retrieveParameter($experience_input, 'responsibilities', false, []);
      $experience->description = implode (", ", $responsibilities);

      $resume->experiences[] = $experience;
    }

    #educations
    $resume->educations = [];
    foreach ($retrieveParameter($data, 'education', false, []) as $education_input) {
      $education = new stdClass;
      $education->school = $retrieveParameter($education_input, 'school', true);
      $education->degree = $retrieveParameter($education_input, 'degree', true);
      $sd = $retrieveParameter($education_input, 'attended', true);
      $education->start_date = $convertToDate('attended', $sd);
      $ed = $retrieveParameter($education_input, 'attendedto', false);
      $education->end_date =  $convertToDate('attendedto', $ed);
      $education->course_list = $retrieveParameter($education_input, 'courselist', true);
      $education->description = $retrieveParameter($education_input, 'portfolioskills', true);

      $resume->educations[] = $education;
    }


    #references
    $resume->references = [];
    foreach ($retrieveParameter($data, 'reference', false, []) as $reference_input) {
      $reference = new stdClass;
      $reference->first_name = $retrieveParameter($reference_input, 'first_name', true);
      $reference->last_name = $retrieveParameter($reference_input, 'last_name', true);
      $reference->email = $retrieveParameter($reference_input, 'email', true);
      $reference->phone = $retrieveParameter($reference_input, 'phone', false);
      $reference->relation = $retrieveParameter($reference_input, 'relation', false);

      $resume->references[] = $reference;
    }

    return $resume;
}

?>
