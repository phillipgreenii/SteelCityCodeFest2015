<?php

include_once 'user.php';
include_once 'resume.php';

$resume_id = $_GET["id"] or resume_lookup_id_for_user(user_retrieve_current_id());

$resume = resume_load($resume_id);

$pageContents = <<< EOPAGE
<h1>{$resume->person->first_name}
{$resume->person->last_name}</h1>

<p>$resume->introduction</p>
EOPAGE;

echo $pageContents;

?>
