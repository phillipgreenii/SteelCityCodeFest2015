<?php
include_once 'template.php';
include_once 'user.php';
user_redirect_if_not_authenticated();


<<<<<<< HEAD
<body>
	<div id="head">
		<span id="header">Coder's Haven</span>
		<span id="slogan">Catchy Slogan will live here</span>
		<div id="head_nav"> 
			<ul id="nav">
				<li class="li_Nav"><a href="#">Home</a></li>
				<li class="li_Nav"><a href="#">Job Search</a></li>
				<li class="li_Nav"><a href="#">Resume</a></li>
				<li class="li_Nav"><a href="#">Browse</a></li>
			</ul>
		</div>
	</div>

	<div id="content">
		<form>
			<label for="textfield">Intro:</label>
			<input type="text" name="intro" id="textfield"><br>
			<label for="textfield">Emphasises:</label>
			<input type="text" name="emphasises" id="emphasises"><br>
			<label for="textfield">Skills:</label>
			<input type="text" name="skills" id="skills"><br>
			<label for="textfield">Education:</label>
			<input type="text" name="education" id="education"><br>
			<label for="textfield">Experience:</label><br>
			<label for="textfield">Title:</label>
			<input type="text" name="title" id="title"><br>
			<label for="textfield">Time Frame From:</label>
			<input type"text" name="from" id="from">
			<label for="textfield">To:</label>
			<input type="text" name="to" id="to"><br>
			<label for="textfield">Company:</label>
			<input type="text" name="company" id="company"><br>
			<label for="textfield">Description:</label>
			<input type="text" name="description" id="description"><br>
			<label for="textfield">Education:</label><br>
			<label for="textfield">Degree:</label>
			<input type="text" name="degree" id="degree"><br>
			<label for="textfield">Attended From:</label>
			<input type"text" name="attended" id="attended">
			<label for="textfield">To:</label>
			<input type="text" name="attendedto" id="attendedto"><br>
			<label for="textfield">Course List:</label>
			<input type="text" name="courselist" id="courselist"><br>
			<label for="textfield">Portfolio Skills:</label>
			<input type="text" name="portfolioskills" id="portfolioskills"><br>
			<label for="text">References:</label>
			<label for="textfield">Name:</label>
			<input type="text" name="name" id="name"><br>
			<label for="textfield">Email:</label>
			<input type="text" name="email" id="email"><br>
			<label for="textfield">Phone:</label>
			<input type="text" name="phone" id="phone"><br>
			<label for="textfield">Relation:</label>
			<input type="text" name="relation" id="relation"><br>
		</form>
	</div>
  
	
</body>
</html>
=======
$pageContents = <<< EOPAGE
<form>
  <label for="textfield">Intro:</label>
  <input type="text" name="intro" id="textfield"><br>
  <label for="textfield">Emphasises:</label>
  <input type="text" name="emphasises" id="emphasises"><br>
  <label for="textfield">Skills:</label>
  <input type="text" name="skills" id="skills"><br>
  <label for="textfield">Education:</label>
  <input type="text" name="education" id="education"><br>
  <label for="textfield">Experience:</label><br>
  <label for="textfield">Title:</label>
  <input type="text" name="title" id="title"><br>
  <label for="textfield">Time Frame From:</label>
  <input type"text" name="from" id="from">
  <label for="textfield">To:</label>
  <input type="text" name="to" id="to"><br>
  <label for="textfield">Company:</label>
  <input type="text" name="company" id="company"><br>
  <label for="textfield">Description:</label>
  <input type="text" name="description" id="description"><br>
  <label for="textfield">Education:</label><br>
  <label for="textfield">Degree:</label>
  <input type="text" name="degree" id="degree"><br>
  <label for="textfield">Attended From:</label>
  <input type"text" name="attended" id="attended">
  <label for="textfield">To:</label>
  <input type="text" name="attendedto" id="attendedto"><br>
  <label for="textfield">Course List:</label>
  <input type="text" name="courselist" id="courselist"><br>
  <label for="textfield">Portfolio Skills:</label>
  <input type="text" name="portfolioskills" id="portfolioskills"><br>
  <label for="text">References:</label>
  <label for="textfield">Name:</label>
  <input type="text" name="name" id="name"><br>
  <label for="textfield">Email:</label>
  <input type="text" name="email" id="email"><br>
  <label for="textfield">Phone:</label>
  <input type="text" name="phone" id="phone"><br>
  <label for="textfield">Relation:</label>
  <input type="text" name="relation" id="relation"><br>
</form>
>>>>>>> origin/master
EOPAGE;

echo wrap_full_template($pageContents);
?>
