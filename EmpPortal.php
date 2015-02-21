<?php

$pageContents = <<< EOPAGE
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Coder's Haven</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/main-custom.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/main-custom.js"></script>
</head>

<body>
	<div id="head">
		<span id="header">Coder's Haven</span>
		<span id="slogan">Catchy Slogan will live here</span>
		<div id="head_nav">
			<ul id="nav">
				<li class="li_Nav"><a href="#">Skill Search</a></li>
				<li class="li_Nav"><a href="#">View Jobs</a></li>
				<li class="li_Nav"><a href="#">Edit Jobs</a></li>
				<li class="li_Nav"><a href="#">Add Jobs</a></li>
			</ul>
		</div>
	</div>

	<div id="content">
	</div>
  
	<footer class="footer">
		<div class="container">
			<p class="text-muted">Product of Steel City Codefest 2015.</p>
		</div>
	</footer>
</body>
</html>
EOPAGE;

echo $pageContents;
?>