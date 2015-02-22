<?php
include_once 'template.php';
include_once 'user.php';
user_redirect_if_not_authenticated();

$links = '';

if(user_is_candidate()) {
  $links = $links . <<<EOL
  <div>
  <h2>Candidate Links</h2>
  <ul>
  <li><a href="ViewResume.php">View Resume</a></li>
  </ul>
  </div>
EOL;
}

if(user_is_employer()) {
  $links = $links . <<<EOL
  <div>
  <h2>Employeer Links</h2>
  <ul>
  <li><a href="ViewJobs.php">View Jobs</a></li>
  </ul>
  </div>
EOL;
}

$pageContents = <<< EOPAGE
{$links}
EOPAGE;

echo wrap_full_template($pageContents);
?>
