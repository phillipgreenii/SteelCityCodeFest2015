<?php
include_once 'user.php';

user_logout();

/* Redirect to a different page in the current directory that was requested */
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
http_response_code(302);
header("Location: http://$host$uri/");
exit;
?>
