<?php 



$huan = $_POST['usname'];
$two = $_POST['psname'];
$setlimit = 10000;

setcookie('usname', $huan, time()+$setlimit);
setcookie('psword', $two, time()+$setlimit);


require '../functions - Copy/dbcon.php';
require '../functions - Copy/default.php';





if(isset($_POST['usname']) && isset($_POST['psname']))
 {
	 $huan = $_POST['usname'];
	 $two = $_POST['psname'];
	 $usnameme = 'admin'; 
	 $psnameme = '24428142258';
	 
	 
$query  = "SELECT * FROM `useracct` WHERE username LIKE '". $huan ."' AND password LIKE '". $two ."'"; //SQL FORMAT FOR SEARCHING 


	 $numrows = mysql_num_rows(mysql_query($query));
	 
	 if($numrows != 0) 
	 {
		echo '
	<script> 
window.location.replace("'.$default.'home.php");
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
   
      