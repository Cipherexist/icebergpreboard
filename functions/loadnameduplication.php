<?php 

include 'dbcon.php';

function loadnameduplication($firstname,$middlename,$lastname,$bdate)
{ 
$fname = trim(strtoupper($firstname));
$mname = trim(strtoupper($middlename));
$lname = trim(strtoupper($lastname));

$query = "SELECT * from trainee Where firstname Like '". $fname ."' and middlename Like '" .$mname . "' and lastname Like '" . $lname . 
"' and birthdate Like '" .$bdate. "'" ;

$mysqldata = mysql_query($query);

if($run = mysql_fetch_assoc($mysqldata))
{
$z = '<p> You are already enrolled in our system </p> <p style="color:#F00;"> Your information is ' . $fname. ' ' . $mname. ' ' . $lname . ' Birthdate of: '. $bdate .'</p> <p> Kindly Proceed to Step 2 for login information and enter this traineecode <span style="color:#F00;">' . $run["traineecode"] . '</span>, avoid duplication or spamming, it may block your ipaddress on accessing us. </p> ';	
return $z; 
}
else 
{
	$z = 'proceed'; 
 
return $z; 
} 


} 











?> 