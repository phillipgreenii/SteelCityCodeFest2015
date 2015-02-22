<?php
include_once 'user.php';
include_once 'support.php';

user_logout();

add_location_header();
http_response_code(302);
exit;
?>
