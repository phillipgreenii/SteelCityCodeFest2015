<?php
$host = "localhost";
$username = "codefest";
$password = "codefest";
$database = "codefest";

$mysql = new mysqli($host, $username, $password, $database);

$ud_fn = trim($_POST["txtUD_FN"]);
$ud_ln = trim($_POST["txtUD_LN"]);
$ud_mi = trim($_POST["txtUD_MI"]);
$ud_sx = trim($_POST["txtUD_SX"]);
$ud_em = trim($_POST["txtUD_EM"]);
$ud_pn = trim($_POST["txtUD_PN"]);
$ud_un = trim($_POST["txtUD_UN"]);
$ud_pw = trim($_POST["txtUD_PW"]);
$ud_sl = trim($_POST["txtUD_SL"]);
$ud_role = $_POST["chkRole"];
$ud_comp = trim($_POST["cboUD_CM"]);
$cd_cn = trim($_POST["txtCD_CN"]);
$cd_cp = trim($_POST["txtCD_CP"]);
$cd_cd = trim($_POST["txtCD_CD"]);
$cd_ca = trim($_POST["txtCD_CA"]);
$cd_pn = trim($_POST["txtCD_PN"]);
$cd_ce = trim($_POST["txtCD_CE"]);
$jd_jt = trim($_POST["txtJD_JT"]);
$jd_sa = trim($_POST["txtJD_SA"]);
$jd_sd = date("Y-m-d H:i:s", date_timestamp_get(date_create(trim($_POST["txtJD_SD"]))));
$jd_ed = date("Y-m-d H:i:s", date_timestamp_get(date_create(trim($_POST["txtJD_ED"]))));
$jd_jd = trim($_POST["txtJD_JD"]);
$jd_jr = trim($_POST["txtJD_JR"]);
$jd_jb = trim($_POST["txtJD_JB"]);
$jd_comp = trim($_POST["cboJD_CM"]);
$st_tag = trim($_POST["txtST_Tag"]);
$st_jobs = $_POST["cboST_Jobs"];

if(isset($_POST["btnST_Submit"]))
{
	$query = "INSERT INTO tags(TagText) VALUES(?)";
	$stmt = $mysql->prepare($query);
	$tagtext = "";
	$stmt->bind_param("s", $st_tag);
	if(!$stmt->execute())
	{
		echo $query."<br />";
		echo "<pre>";
		print_r($mysql);
		echo "<br /><br />";
		print_r($stmt);
		echo "</pre>";
		die();
	}
	$stmt->close();
	$query = "SELECT TagID FROM tags WHERE TagText = ?";
	$stmt = $mysql->prepare($query);
	$stmt->bind_param("s", $st_tag);
	if(!$stmt->execute())
	{
		echo $query."<br />";
		echo "<pre>";
		print_r($mysql);
		echo "<br /><br />";
		print_r($stmt);
		echo "</pre>";
		die();
	}
	$stmt->bind_result($tid);
	$stmt->fetch();
	$stmt->close();
	$query = "INSERT INTO jobtags(JobID, TagID) VALUES(?,?)";
	$stmt = $mysql->prepare($query);
	if(!$stmt)
	{
		echo $query."<br />";
		echo "<pre>";
		print_r($mysql);
		die();
	}
	$stmt->bind_param("ii", $jid, $tid);
	foreach($st_jobs as $jid)
	{
		if(!$stmt->execute())
		{
			echo $query."<br />";
			echo "<pre>";
			print_r($mysql);
			echo "<br /><br />";
			print_r($stmt);
			echo "</pre>";
			die();
		}
	}
	$stmt->close();
}
else if(isset($_POST["btnUD_Submit"]))
{
	if(count($ud_role) === 0 || $ud_fn === "" || $ud_ln === "" || $ud_em === "" || $ud_pn === "" || $ud_pw === "" || $ud_un === "")
	{
		echo "<h1>ERROR IN DATA ENTRY.  MAKE SURE ALL DATA IS DEFINED.</h1>";
	}
	else
	{
		if(count($ud_role) === 1 && $ud_role[0] === "emp" && $ud_comp === "")
		{
			echo "<h1>ERROR IN DATA ENTRY.  MAKE SURE ALL DATA IS DEFINED.</h1>";
		}
		else if(count($ud_role) === 2 && $ud_comp === "")
		{
			echo "<h1>ERROR IN DATA ENTRY.  MAKE SURE ALL DATA IS DEFINED.</h1>";
		}
		else
		{
			$query = "INSERT INTO users(FirstName, LastName, MiddleInitial, Suffix, Username, Password, Salt, Email, Phone) VALUES(?,?,?,?,?,?,?,?,?)";
			$stmt = $mysql->prepare($query);
			$stmt->bind_param("sssssssss", $ud_fn, $ud_ln, $ud_mi, $ud_sx, $ud_un, $ud_pw, $ud_sl, $ud_em, $ud_pn);
			$stmt->execute();
			$stmt->close();
			$query = "SELECT RoleID FROM roles WHERE RoleName = ?";
			$stmt = $mysql->prepare($query);
			if($ud_role[0] === "user") $name = "Candidate";
			else $name = "Employer";
			$stmt->bind_param("s", $name);
			$stmt->execute();
			$stmt->bind_result($rid);
			$stmt->fetch();
			$stmt->close();
			$query = "SELECT UserID FROM users WHERE Username = ?";
			$stmt = $mysql->prepare($query);
			$stmt->bind_param("s", $ud_un);
			$stmt->execute();
			$stmt->bind_result($uid);
			$stmt->fetch();
			$stmt->close();
			$query = "INSERT INTO userroles(UserID, RoleID) VALUES(?, ?)";
			$stmt = $mysql->prepare($query);
			$stmt->bind_param("ii", $uid, $rid);
			$stmt->execute();
			$stmt->close();
			if($name === "Employer")
			{
				$query = "INSERT INTO usercompany(UserID, CompanyID) VALUES(?, ?)";
				$stmt = $mysql->prepare($query);
				$stmt->bind_param("ii", $uid, $ud_comp);
				if(!$stmt->execute())
				{
					echo $query."<br />Uid = $uid<br />Comp = $ud_comp<br />";
					echo "<pre>";
					print_r($mysql);
					echo "<br /><br />";
					print_r($stmt);
					echo "</pre>";
					die();
				}
				$stmt->close();
			}
			if(count($ud_role) === 2)
			{
				$query = "SELECT RoleID FROM roles WHERE RoleName = ?";
				$stmt = $mysql->prepare($query);
				if($ud_role[1] === "user") $name = "Candidate";
				else $name = "Employer";
				$stmt->bind_param("s", $name);
				$stmt->execute();
				$stmt->bind_result($rid);
				$stmt->fetch();
				$stmt->close();
				$query = "SELECT UserID FROM users WHERE Username = ?";
				$stmt = $mysql->prepare($query);
				$stmt->bind_param("s", $ud_un);
				$stmt->execute();
				$stmt->bind_result($uid);
				$stmt->fetch();
				$stmt->close();
				$query = "INSERT INTO userroles(UserID, RoleID) VALUES(?, ?)";
				$stmt = $mysql->prepare($query);
				$stmt->bind_param("ii", $uid, $rid);
				$stmt->execute();
				$stmt->close();
				if($name === "Employer")
				{
					$query = "INSERT INTO usercompany(UserID, CompanyID) VALUES(?, ?)";
					$stmt = $mysql->prepare($query);
					$stmt->bind_param("ii", $uid, $un_comp);
					if(!$stmt->execute())
					{
						echo "<pre>";
						print_r($mysql);
						echo "<br /><br />";
						print_r($stmt);
						echo "</pre>";
						die();
					}
					$stmt->close();
				}
			}
			$ud_fn=$ud_ln=$ud_mi=$ud_sx=$ud_un=$ud_pw=$ud_sl=$ud_em=$ud_pn="";
		}
	}
}
else if(isset($_POST["btnCD_Submit"]))
{
	$query = "INSERT INTO companies(CompanyName, Phone, Email, Description, Address) VALUES(?,?,?,?,?)";
	$stmt = $mysql->prepare($query);
	if(!$stmt)
	{
		die("ERROR CREATING STATEMENT");
	}
	$stmt->bind_param("sssss", $cd_cn, $cd_cp, $cd_ce, $cd_cd, $cd_ca);
	if(!$stmt->execute())
	{
		echo "<pre>";
		print_r($mysql);
		echo "<br /><br />";
		print_r($stmt);
		echo "</pre>";
		die();
	}
	$stmt->close();
	$cd_cn = $cd_cp = $cd_ce = $cd_cd = $cd_ca = "";
}
else if(isset($_POST["btnJD_Submit"]))
{
	$query = "INSERT INTO jobs(JobTitle, Description, Requirements, Salary, StartDate, EndDate, Benefits) VALUES(?,?,?,?,?,?,?)";
	$stmt = $mysql->prepare($query);
	$stmt->bind_param("sssssss", $jd_jt, $jd_jd, $jd_jr, $jd_sa, $jd_sd, $jd_ed, $jd_jb);
	if(!$stmt->execute())
	{
		echo "<pre>";
		print_r($mysql);
		echo "<br /><br />";
		print_r($stmt);
		echo "</pre>";
		die();
	}
	$stmt->close();
	$query = "SELECT JobID FROM jobs WHERE JobTitle = ? AND StartDate = ? AND EndDate = ?";
	$stmt = $mysql->prepare($query);
	$stmt->bind_param("sss", $jd_jt, $jd_sd, $jd_ed);
	if(!$stmt->execute())
	{
		echo "<pre>";
		print_r($mysql);
		echo "<br /><br />";
		print_r($stmt);
		echo "</pre>";
		die();
	}
	$stmt->bind_result($jid);
	$stmt->fetch();
	$stmt->close();
	$query = "INSERT INTO companyjobs(CompanyID, JobID) VALUES(?,?)";
	$stmt = $mysql->prepare($query);
	$stmt->bind_param("ii", $jd_comp, $jid);
	if(!$stmt->execute())
	{
		echo "<pre>";
		print_r($mysql);
		echo "<br /><br />";
		print_r($stmt);
		echo "</pre>";
		die();
	}
	$stmt->close();
	$jd_comp = $jd_ed = $jd_jb = $jd_jd = $jd_jr = $jd_jt = $jd_sa = $jd_sd = "";
}

$comp_arr = array();

$query = "SELECT * FROM companies";

$stmt = $mysql->prepare($query);
$stmt->execute();
$stmt->bind_result($cid, $desc, $addr, $phone, $email, $name);
while($stmt->fetch() === true)
{
	$comp_arr[] = array("CompanyID"=>$cid,"CompanyName"=>$name,"CompanyDescription"=>$desc,"CompanyAddress"=>$addr,"CompanyPhone"=>$phone,"CompanyEmail"=>$email);
}
$stmt->close();

$query = "SELECT j.JobID, j.JobTitle, c.CompanyName FROM jobs as j INNER JOIN companyjobs as cj ON j.JobID = cj.JobID INNER JOIN companies as c ON cj.CompanyID = c.CompanyID";
$stmt = $mysql->prepare($query);
$stmt->execute();
$stmt->bind_result($jid, $jtit, $cname);
$job_arr = array();
while($stmt->fetch() === true)
{
	$job_arr[] = array("JobID"=>$jid,"JobTitle"=>$jtit,"CompanyName"=>$cname);
}
$stmt->close();

$mysql->close();
?>
<form id="form1" name="form1" method="post">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.datepicker.min.js" type="text/javascript"></script>

<p>DATABASE MODIFICATION SCRIPT</p>
  <p>This script is used for entering data directly into the database for testing purposes. No data validation is performed.</p>
<hr>
<!--  
<p><strong>USER DATA</strong></p>
  <p>
    <label for='txtCD_CN'>First name:</label>
    <input type='text' name='txtUD_FN' id='txtUD_FN' value='$ud_fn'>
    <br>
   Middle
   <label for='textfield3'> initial:</label>
    <input type='text' name='txtUD_MI' id='txtUD_MI' value='$ud_fn'>
    <br>
    <label for='textfield4'>Last
    name:
      <input type='text' name='txtUD_LN' id='txtUD_LN' value='$ud_ln'>
      <br>
Suffix:</label>
    <input type='text' name='txtUD_SX' id='txtUD_SX' value='$ud_sx'>
  </p>
  <p>Phone number
    <label for='textfield6'>:</label>
    <input type='text' name='txtUD_PN' id='txtUD_PN' value='$ud_pn'>
    <br> 
    Email address
    <label for='textfield7'>:</label>
   <input type='text' name='txtUD_EM' id='txtUD_EM' value='$ud_em'>
  </p>
  <p>Username
    <label for='textfield8'>:</label>
    <input type='text' name='txtUD_UN' id='txtUD_UN' value='$ud_un'>
    <br> 
    Password
    <label for='textfield9'>:</label>
   <input type='text' name='txtUD_PW' id='txtUD_PW' value='$ud_pw'>
   <br> 
    Salt:
   <input type='text' name='txtUD_SL' id='txtUD_SL' value='$ud_sl'>
   <br>
   Role: 
   <label>
     <input type='checkbox' name='chkRole[]' value='emp' id='chkRole_0'>
     Employer</label>
   <label>
     <input type='checkbox' name='chkRole[]' value='user' id='chkRole_1'>
    User</label>
   <br>;
   Company (if chosing Employer role): ";
   echo "<select name='cboUD_CM' id='cboUD_CM'>";
   foreach($comp_arr as $line)
   {
	   $id = $line['CompanyID'];
	   $val = $line['CompanyName'];
	   echo "<option value='".$id."'>".$val."</option>";
   }
   echo "</select>
   <br>
   <input type='submit' name='btnUD_Submit' id='btnUD_Submit' value='Submit'>
  </p>
  <hr>-->
  <?php echo "<p><strong>COMPANY DATA</strong></p>
  <p>Company name:
    <input type='text' name='txtCD_CN' id='txtCD_CN' value='$cd_cn'>
    <br>
    Company description: 
    <textarea name='txtCD_CD' cols='100' rows='10' id='txtCD_CD'>$cd_cd</textarea>
    <br>
    Company address:
    <textarea name='txtCD_CA' cols='50' rows='5' id='txtCD_CA' form='form1'>$cd_ca</textarea>
<br>
  Company phone:
    <input type='text' name='txtCD_CP' id='txtCD_CP' value='$cd_cp'>
    <br>
    Company email:
    <input type='text' name='txtCD_CE' id='txtCD_CE' value='$cd_ce'>
    <br>
    <input type='submit' name='btnCD_Submit' id='btnCD_Submit' value='Submit'>
  </p>
  <hr>
  <p><strong>JOB DATA</strong></p>
  <p>Company:";
   echo "<select name='cboJD_CM' id='cboJD_CM'>";
   foreach($comp_arr as $line)
   {
	   $id = $line['CompanyID'];
	   $val = $line['CompanyName'];
	   echo "<option value='".$id."'>".$val."</option>";
   }
   echo "</select>"; echo "<br>Job title:
    <input type='text' name='txtJD_JT' id='txtJD_JT' value='$jd_jt'>
    <br>
     Salary:
      <input type='text' name='txtJD_SA' id='txtJD_SA' value='$jd_sa'>
    <br>
    Start date:
    
    <input name='txtJD_SD' type='text' id='txtJD_SD'>
    <br>
End date:
<input name='txtJD_ED' type='text' id='txtJD_ED'>
<br>
    Job description:
    <textarea name='txtJD_JD' cols='100' rows='10' id='txtJD_JD' form='form1'>$jd_jd</textarea>
    <br>
    Requirements:
<textarea name='txtJD_JR' cols='100' rows='10' id='txtJD_JR' form='form1'>$jd_jr</textarea>
    <br>
    Benefits:
    <textarea name='txtJD_JB' cols='100' rows='10' id='txtJD_JB' form='form1'>$jd_jb</textarea>
    <br>
    <input type='submit' name='btnJD_Submit' id='btnJD_Submit' value='Submit'>
    
  </p>
  <hr>
  <p><strong>SKILL TAGS</strong></p>
  <p>Enter tags to be used for job entries.<br>
    Tag
      <label for='txtST_Tags'>:</label>
    <input type='text' name='txtST_Tag' id='txtST_Tag'>
    <br>
<label for='cboST_Jobs'>Assign to existing job(s):<br>
</label>
    <select name='cboST_Jobs[]' size='5' multiple='MULTIPLE' id='cboST_Jobs'>";
	foreach($job_arr as $line)
	{
		$jid = $line["JobID"];
		$name = $line["JobTitle"];
		$comp = $line["CompanyName"];
		echo "<option value='".$jid."'>".$name." (".$comp.")</option>";
	}
    echo"</select>
    <br>
    <input type='submit' name='btnST_Submit' id='btnST_Submit' value='Submit'>
  </p>
</form>";
?>
<script type="text/javascript">
$(function() {
	$( "#txtJD_SD" ).datepicker({
		changeMonth:true,
		changeYear:true,
		showButtonPanel:true
	}); 
});
$(function() {
	$( "#txtJD_ED" ).datepicker({
		changeMonth:true,
		changeYear:true,
		showButtonPanel:true
	}); 
});
</script>
