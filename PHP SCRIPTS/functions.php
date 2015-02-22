<?php
function include_exists ($fileName){
    if (realpath($fileName) == $fileName) {
        return is_file($fileName);
    }
    if ( is_file($fileName) ){
        return true;
    }

    $paths = explode(PATH_SEPARATOR, get_include_path());
    foreach ($paths as $path) {
        $rp = substr($path, -1) == DIRECTORY_SEPARATOR ? $path.$fileName : $path.DIRECTORY_SEPARATOR.$fileName;
        if ( is_file($rp) ) {
            return true;
        }
    }
    return false;
}

if(include_exists("vars.php"))
{
	include_once("vars.php");
	$dbhost = $GBL_DBHOST;
	$dbuser = $GBL_DBUSER;
	$dbpass = $GBL_DBPASS;
	$dbname = $GBL_DBNAME;
}
else
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "codefest";
}

function GetJobListJSON()
{
	global $dbhost, $dbuser, $dbpass, $dbname;
	$mysql = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	$query = "SELECT j.JobID, j.JobTitle, j.Description AS JobDescription, j.Requirements, j.Salary, j.StartDate, j.EndDate, j.Benefits, c.CompanyID, c.Description AS CompanyDescription, c.Address, c.Phone, c.Email, c.CompanyName FROM jobs as j INNER JOIN companyjobs as cj ON j.JobID = cj.JobID INNER JOIN companies AS c ON cj.CompanyID = c.CompanyID";
	$job_arr = array();
	$stmt = $mysql->prepare($query);
	if(!$stmt)
	{
		echo "Failed to prepare $query<br />";
		echo "<pre>";
		print_r($mysql);
		echo "</pre>";
		die();
	}
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
	$stmt->bind_result($jid, $jtitle, $jdesc, $jreq, $jsal, $jstart, $jend, $jbenefits, $cid, $cdesc, $caddr, $cphone, $cemail, $cname);
	while($stmt->fetch() === true)
	{
		$job_arr[] = array("Tags"=>"","JobID"=>$jid,"JobDescription"=>$jdesc,"Requirements"=>$jreq,"Salary"=>$jsal,"StartDate"=>$jstart,"EndDate"=>$jend,"Benefits"=>$jbenefits,"CompanyID"=>$cid,"CompanyDescription"=>$cdesc, "Address"=>$caddr,"Phone"=>$cphone,"Email"=>$cemail,"CompanyName"=>$cname);
	}
	$stmt->close();
	$query = "SELECT TagText FROM tags INNER JOIN jobtags ON tags.TagID = jobtags.TagID WHERE jobtags.JobID = ?";
	$index = -1;
	foreach($job_arr as $line)
	{
		++$index;
		$jid = intval($line["JobID"]);
		$stmt = $mysql->prepare($query);
		if(!$stmt)
		{
			echo "Failed to prepare $query<br />";
			echo "<pre>";
			print_r($mysql);
			echo "</pre>";
			die();
		}
		$stmt->bind_param("i", $jid);
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
		$stmt->bind_result($tag);
		while($stmt->fetch() === true)
		{
			$job_arr[$index]["Tags"] .= $tag.", ";
		}
		$job_arr[$index]["Tags"] = trim($job_arr[$index]["Tags"]);
		$job_arr[$index]["Tags"] = substr($job_arr[$index]["Tags"], 0, strlen($job_arr[$index]["Tags"]) - 1);
		$stmt->close();
	}
	$mysql->close();
	return json_encode($job_arr);
}
?>