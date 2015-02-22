<?php
include_once 'template.php';
include_once 'user.php';
user_redirect_if_not_authenticated();


$pageContents = <<< EOPAGE

EOPAGE;

echo wrap_full_template($pageContents);
?>
