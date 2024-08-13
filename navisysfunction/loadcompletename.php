<?php 

require '../dbcon.php'; 


function completename($tcode)

{
	
$query = "SELECT * from trainee Where traineecode Like '" .$tcode. "'";

$mysqldata = mysql_query($query);

if($run = mysql_fetch_assoc($mysqldata))
{
	
if($run['middlename']!="")
{
	$tuldok1 = ".";
}
else 
{
	$tuldok1 ="";
}

if($run['suffix1']!="")
{
	$tuldok2 = ".";
}
else 
{
	$tuldok2 ="";
}

if($run['suffix2']!="")
{
	$tuldok3 = ".";
}
else 
{
	$tuldok3 ="";
}

	
	
$completedetails =  $run['firstname'] .' '. $run['suffix1'] . $tuldok2 .' '. $run['middleinitial'] . $tuldok1 .' '. $run['lastname'] .' '. $run['suffix2']. $tuldok3 ;
	return $completedetails;
}
else 
{ 
echo 'There is no Record Found';
} 
}


?> 

