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
				<li class="li_Nav"><a href="#">Home</a></li>
				<li class="li_Nav"><a href="#">About</a></li>
				<li class="li_Nav"><a href="#">Contact</a></li>
				<li class="li_Nav"><a href="#">Browse</a></li>
				<li class="li_Nav" data-toggle="modal" data-target="#myModal"><a href="#">Login</a></li>
			</ul>
		</div>
	</div>

	<div id="content">
		<div id="registration">
			<form id=reg">
				<p>
					<label for="fname">First Name:</label>
					<input type="text" name="fname" id="fname">  
				</p>
				
				<p>
					<label for="m_init">Middle Initial:</label>
					<input type="text" name="m_init" id="m_init">  
				</p>

				<p>
					<label for="lname">Last Name:</label>
					<input type="text" name="lname" id="lname">
				</p>
				
				<p>
					<label for="suffix">Suffix:</label>
					<input type="text" name="suffix" id="suffix">
				</p>
				
				<p>
					<label for="email">Email:</label>
					<input type="text" name="email" id="email">  
				</p>

				<p>
					<label for="phone">Phone Number:</label>
					<input type="text" name="phone" id="phone">
				</p>
				
				<p>
					<label for="user">Username:</label>
					<input type="text" name="user" id="user">  
				</p>

				<p>
					<label for="pass">Password:</label>
					<input type="text" name="pass" id="pass">
				</p>
				
				<p>
					<label for="con_pass">Confirm Password:</label>
					<input type="text" name="con_pass" id="con_pass">  
				</p>
 
				<p>
					<label for="lname">Last Name:</label> 
					<input type="checkbox" name="user_type" value="type_user">Candidates<br>
					<input type="checkbox" name="user_type" value="type_emp">Employer<br>
				</p>
				
				<p>
					<button type="button" id="sub_reg" class="btn btn-primary">Register</button> 
					<button type="button" id="login" class="btn">Clear</button>
				</p>
				
			</form>
		</div>
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