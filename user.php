<?php
include_once 'db.php';
session_start();


function user_retrieve_current_id() {
  return $_SESSION['user_id'] or die('no current user id');
}




?>
