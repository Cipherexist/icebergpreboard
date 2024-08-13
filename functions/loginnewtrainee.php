<?php 



$trcode = $_POST['trcode'];
$trpsword = $_POST['psword'];


require '../dbcon.php';

$query = "UPDATE `trainee` SET `password` = '".$trpsword."' WHERE traineecode Like '" .$trcode . "'";
if($run = mysql_query($query))
{ 
}
else 
{ 

} /*end of database saving */


if(isset($_POST['trcode']) && isset($_POST['psword']))
 {
	
	 
$query  = "SELECT * FROM `trainee` WHERE traineecode LIKE '". $trcode ."' AND password LIKE '". $trpsword ."'"; //SQL FORMAT FOR SEARCHING 


	 $numrows = mysql_num_rows(mysql_query($query));
	 
	 if($numrows != 0) 
	 {
$setlimit = 10000;

setcookie('trcode', $trcode, time()+$setlimit);
setcookie('trpass', $trpsword, time()+$setlimit);
		echo '
	<script> 
window.location.replace("'.$default.'ots.php");
</script> 
	
	';
	die();
	 }
	 else 
	 { 
	 echo '  <p style="color:#F66; font-family:"Copperplate Gothic Bold""> Login-details incorrect </p>';
	 } 
	 
 }


?>
   
      