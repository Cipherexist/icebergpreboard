<?php 
if(!empty($_COOKIE['usname']) && !empty($_COOKIE['psword'])){ 

$sname = $_COOKIE['usname'];
$pword = $_COOKIE['psword'];
require 'dbconfig.php';

$fetchqry  = "SELECT * FROM `user_data` WHERE username LIKE '". $sname  ."' AND accesstype LIKE 'Admin' AND password LIKE '". $pword ."'" ; //SQL FORMAT FOR SEARCHING 

$result=mysqli_query($con,$fetchqry);
$num_row=mysqli_num_rows($result);

if ($num_row != 0) 
{

} 
else 
{
echo '
<script> 
window.location.replace("index.php");</script> 
';	
}

}
else 
{ 
echo '
<script> 
window.location.replace("index.php");
</script> 
';	
} 


?> 


