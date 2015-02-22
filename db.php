<?php
function include_exists ($fileName){
    if (realpath($fileName) == $fileName) {
        return is_file($fileName);
    }
    if ( is_file($fileName) ){
        return true;
    }

    $paths = explode(PATH_SEPARATOR, get_include_path());
    foreach ($paths as $path) {
        $rp = substr($path, -1) == DIRECTORY_SEPARATOR ? $path.$fileName : $path.DIRECTORY_SEPARATOR.$fileName;
        if ( is_file($rp) ) {
            return true;
        }
    }
    return false;
}

if(include_exists("vars.php"))
{
	include_once("vars.php");
	$dbhost = $GBL_DBHOST;
	$dbuser = $GBL_DBUSER;
	$dbpass = $GBL_DBPASS;
	$dbname = $GBL_DBNAME;
}
else
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "codefest";
}


$_connection = NULL;

function db_open() {
  global $dbhost, $dbuser, $dbpass, $dbname;

  if(empty($_connection)) {
    $_connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("The site database appears to be down.");;
  }

  return $_connection;
}
