<?php 
if(!empty($_COOKIE['usname']) && !empty($_COOKIE['psword'])){ 

$sname = $_COOKIE['usname'];
$pword = $_COOKIE['psword'];
require '../functions - Copy/dbcon.php';

$query  = "SELECT * FROM `useracct` WHERE username LIKE '". $sname ."' AND password LIKE '". $pword ."'"; //SQL FORMAT FOR SEARCHING 


$num_row = mysql_num_rows(mysql_query($query));

if ($num_row != 0) 
{

} 
else 
{
echo '
<script> 
window.location.replace("/navisys/login.php");</script> 
';	
}

}
else 
{ 
echo '
<script> 
window.location.replace("/navisys/login.php");
</script> 
';	
} 


?> 


