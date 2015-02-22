<?php
include_once 'template.php';
include_once 'user.php';
include_once 'resume.php';
user_redirect_if_not_authenticated();

$resume_id = (isset($_GET["id"]) && !isempty($_GET["id"])) || resume_lookup_id_for_user(user_retrieve_current_id());

$resume = resume_load($resume_id);
$pageContents = <<< EOPAGE
<h1>{$resume->person->first_name}
{$resume->person->last_name}</h1>

<p>$resume->introduction</p>
EOPAGE;

echo wrap_full_template($pageContents);
?>
