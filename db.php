<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "codefest";

$_connection = NULL;

function db_open() {
  global $dbhost, $dbuser, $dbpass, $dbname;

  if(empty($_connection)) {
    $_connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die("The site database appears to be down.");;
  }

  return $_connection;
}
