<?php 
require '../functions - Copy/dbcon.php'; 

function ipcheck()
{ 

$ipaddress = getclientip();
$query = "SELECT * from ipaddressblocker Where ipaddress Like '".$ipaddress."'";
$z = 'proceed'; 

$mysqldata = mysql_query($query);

if($run = mysql_fetch_assoc($mysqldata))
{
	$z = 'Your ipaddress is (blocked ' . $ipaddress . ') (reason: '. $run['reason'] . ') (date: ' .$run['dateblocked'] . ') (time: ' .$run['timeblocked'] .') please contact administrator';
	return $z;
}
else 
{
return $z; 
}
} 


?>



