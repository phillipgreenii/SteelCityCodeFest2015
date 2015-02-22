<?php
include_once 'template.php';


$pageContents = <<< EOPAGE
		<div id="registration">
			<form id="reg">
				<div class="form-group">
					<label for="fname">First Name:</label>
					<input type="text" class="form-control" name="fname" id="fname">
				</div>

				<div class="form-group">
					<label for="m_init">Middle Initial:</label>
					<input type="text" class="form-control" name="m_init" id="m_init">
				</div>

				<div class="form-group">
					<label for="lname">Last Name:</label>
					<input type="text" class="form-control" name="lname" id="lname">
				</div>

				<div class="form-group">
					<label for="suffix">Suffix:</label>
					<input type="text" class="form-control" name="suffix" id="suffix">
				</div>

				<div class="form-group">
					<label for="email">Email:</label>
					<input type="text" class="form-control" name="email" id="email">
				</div>

				<div class="form-group">
					<label for="phone">Phone Number:</label>
					<input type="text" class="form-control" name="phone" id="phone">
				</div>

				<div class="form-group">
					<label for="user">Username:</label>
					<input type="text" class="form-control" name="user" id="user">
				</div>

				<div class="form-group">
					<label for="pass">Password:</label>
					<input type="password" class="form-control" name="pass" id="pass">
				</div>

				<div class="form-group">
					<label for="con_pass">Confirm Password:</label>
					<input type="password" class="form-control" name="con_pass" id="con_pass">
				</div>

				<div class="form-group">
					<label for="user_type">Role:</label><br>
					<input type="checkbox" name="user_type[]" value="type_user">Candidate<br>
					<input type="checkbox" name="user_type[]" value="type_emp">Employer<br>
				</div>

				<div class="form-group">
					<button type="button" id="sub_reg" class="btn btn-primary">Register</button>
					<button type="button" id="login" class="btn">Clear</button>
				</div>

			</form>
		</div>
EOPAGE;

echo wrap_full_template($pageContents);
?>
