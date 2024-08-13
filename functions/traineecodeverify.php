<?php 

require '../dbcon.php'; 
require 'loadcompletename.php';


$traineecode = $_POST['trc'];


$query = "SELECT * from trainee Where traineecode Like '" .$traineecode. "'";

$mysqldata = mysql_query($query);

if($run = mysql_fetch_assoc($mysqldata))
{
	
	echo '<script> 
		$("#loginonly").show();
		$("#oldlogin").hide();
	
	</script> ';
}
else 
{ 
echo 'There is no Record Found';
} 

?> 
