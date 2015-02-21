<?php
include_once 'db.php';

function resume_lookup_id_for_user($user_id) {
  return 2;
}


function resume_load($resume_id) {

  $person = new stdClass;
  $person->first_name = "John";
  $person->last_name = "Woo";

  $resume = new stdClass;
  $resume->person = $person;
  $resume->introduction = "this is my reason for why someone should hire me!";

  return $resume;
}


?>
