<?php
include_once 'template.php';
include_once 'user.php';
user_redirect_if_not_authenticated();

$pageContents = <<< EOPAGE
<label for="textfield">Job Title:</label>
<input type="text" name="jobtitle" id="jobtitle"><br>
<label for="textfield">Description:</label>
<input type="text" name="description" id="description"><br>
<label for="textfield">Requirements:</label>
<input type="text" name="requirements" id="requirements"><br>
<label for="textfield">Company Info:</label>
<input type="text" name="companyinfo" id="companyinfo"><br>
<label for="textfield">Pay:</label>
<input type="text" name="pay" id="pay"><br>
<label for="textfield">Duration:</label>
<input type="text" name="duration" id="duration"><br>
<label for="textfield">Benefits:</label>
<input type="text" name="benefits" id="benefits"><br>
EOPAGE;

echo wrap_full_template($pageContents);
?>
