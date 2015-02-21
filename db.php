<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";

function dbConnect($db="") {
global $dbhost, $dbuser, $dbpass;

//FIXME enable once DB is available
// $dbcnx = @mysqli_connect($dbhost, $dbuser, $dbpass)
// or die("The site database appears to be down.");
//
// if ($db!="" and !@mysqli_select_db($db)) {
//   die("The site database is unavailable.");
// }

return $dbcnx;
}
?>
