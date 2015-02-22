<?php
function add_location_header($path="") {
  /* Redirect to a different page in the current directory that was requested */
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/");
}
?>
