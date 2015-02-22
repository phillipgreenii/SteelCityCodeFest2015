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

$experience_section = "";
if(!empty($resume->experiences)) {
  $experience_section = "<div><h2>Experience</h2><dl>";
  forEach($resume->experiences as $experience) {
    $title = "<dt>{$experience->title} ({$experience->company})</dt>";
    $dates = "<dd>{$experience->start_date} - {$experience->end_date}</dd>";
    $description = "<dd>{$experience->description}</dd>";
    $experience_section = $experience_section . $title . $dates . $description;
  }
  $experience_section = $experience_section . "</dl></div>";

}


$education_section = "";
if(!empty($resume->educations)) {
  $education_section = "<div><h2>Education</h2><dl>";
  forEach($resume->educations as $education) {
    $school = "<dt>{$education->school}</dt>";
    $degree = "<dd>{$education->degree}</dd>";
    $dates = "<dd>{$education->start_date} - {$education->end_date}</dd>";
    $description = "<dd>{$education->description}</dd>";
    $course_list = "<dd>{$education->course_list}</dd>";
    $education_section = $education_section . $school. $degree . $dates . $description . $course_list;
  }
  $education_section = $education_section . "</dl></div>";

}


$references_section = "";
if(!empty($resume->references)) {
  $references_section = "<div><h2>References</h2><dl>";
  forEach($resume->references as $reference) {
    $name = "<dt>{$reference->first_name} {$reference->last_name} ({$reference->relation})</dt>";
    $email = "<dd>{$reference->email}</dd>";
    $phone = "<dd>{$reference->phone}</dd>";
    $references_section = $references_section . $name . $email . $phone;
  }
  $references_section = $references_section . "</dl></div>";

}

$pageContents = <<< EOPAGE
<h1>{$resume->person->first_name}
{$resume->person->middle_initial}
{$resume->person->last_name}
{$resume->person->suffix}</h1>
<h2>{$resume->person->email}</h2>
<h2>{$resume->person->phone}</h2>


<p>$resume->introduction</p>
<p>$resume->key_points</p>

{$experience_section}

{$education_section}

{$references_section}

EOPAGE;

echo wrap_full_template($pageContents);
?>
