<?php
include_once 'template.php';
include_once 'user.php';
user_redirect_if_not_authenticated();


$pageContents = <<< EOPAGE
<form>
  <div class="form-group">
    <label for="intro">Introduction:</label>
    <input type="text" class="form-control" name="intro" id="intro">
  </div>

  <div class="form-group">
    <label for="kp1">Key Points:</label>
    <input type="text" class="form-control" name="kp[]" id="kp1">
    <a href="#" id="addKP">Add Another Key Point</a>
  </div>

  <div class="form-group">
    <label for="skills">Skills:</label>
    <input type="text" class="form-control" name="skills" id="skills">
    <a href="#" id="addSkill">Add Another Skill</a>
  </div>


  <h2>Work Experience</h2>

  <div class="form-group">
    <label for="title">Title:</label>
    <input type="text" class="form-control" name="title" id="title">
  </div>

  <div class="form-group">
    <label for="company">Company:</label>
    <input type="text" class="form-control" name="company" id="company">
  </div>

  <div class="form-group">
    <label for="startdate">Start Date:</label>
    <input type"text" class="form-control" name="startdate" id="startdate">
  </div>

  <div class="form-group">
    <label for="enddate">End Date:</label>
    <input type="text"  class="form-control" name="enddate" id="enddate">
  </div>

  <div class="form-group">
    <label for="responsibilities">Resposibilities:</label>
    <input type="text" class="form-control"  name="responsibilities[]" id="responsibilities">
    <a href="#" id="add_resp">Add Another Responsibility</a>
  </div>

  <h2>Education</h2>

  <div class="form-group">
    <label for="school">School:</label>
    <input type="text" class="form-control" name="school" id="school"><br>
  </div>

  <div class="form-group">
    <label for="textfield">Degree:</label>
    <input type="text" class="form-control" name="degree" id="degree">
  </div>

  <div class="form-group">
    <label for="attended">Attended From:</label>
    <input type"text" class="form-control" name="attended" id="attended">
  </div>

  <div class="form-group">
    <label for="attendedto">To:</label>
    <input type="text" class="form-control" name="attendedto" id="attendedto">
  </div>

  <div class="form-group">
    <label for="courselist">Course List:</label>
    <input type="text" class="form-control" name="courselist" id="courselist"><br>
  </div>

  <div class="form-group">
    <label for="portfolioskills">Portfolio Skills:</label>
    <input type="text" class="form-control" name="portfolioskills" id="portfolioskills"><br>
  </div>

  <h2>References</h2>

  <div class="form-group">
    <label for="textfield">Name:</label>
    <input type="text" class="form-control" name="name" id="name"><br>
  </div>

  <div class="form-group">
    <label for="textfield">Email:</label>
    <input type="text" class="form-control" name="email" id="email"><br>
  </div>

  <div class="form-group">
    <label for="textfield">Phone:</label>
    <input type="text" class="form-control" name="phone" id="phone"><br>
  </div>

  <div class="form-group">
    <label for="textfield">Relation:</label>
    <input type="text" class="form-control" name="relation" id="relation"><br>
  </div>

  <div class="form-group">
    <button type="button" id="sub_res" class="btn btn-primary">Submit Resume</button>
    <button type="button" id="login" class="btn">Clear</button>
  </div>
</form>
</body>
</html>
EOPAGE;


echo wrap_full_template($pageContents);
?>
