<?php
include_once 'template.php';
include_once 'user.php';
include_once 'resume.php';
include_once 'support.php';
user_redirect_if_not_authenticated();


if(isset($_GET["id"]) && !empty($_GET["id"])) {
  //if id is specified, try to load it and fail as 404 if it doesn't exist
  $resume_id = $_GET["id"];
  $resume = resume_load($resume_id);

  if(empty($resume)) {
    page_not_found();
  }
} elseif(user_is_candidate()) {
  //if id is not specified, and the user is a candidate, then try to load theirs,
  // if they have none, then navigate to create one
  $resume_id = resume_lookup_id_for_user(user_retrieve_current_id());
  $resume = resume_load($resume_id);

  if(empty($resume)) {
    add_location_header('EditResume.php');
    http_response_code(302);
    exit;
  }
} else {
  //if the user isn't a candidate and they didn't specify an id, then 400
  http_response_code(400);
  echo json_encode(array("errors"=>array("id not specified")));
  exit;
}


$pageContents = <<< EOPAGE
<h1>{$resume->person->first_name}
{$resume->person->last_name}</h1>

<p>$resume->introduction</p>
EOPAGE;

echo wrap_full_template($pageContents);
?>
