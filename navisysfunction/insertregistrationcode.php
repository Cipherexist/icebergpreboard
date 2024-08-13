<?php 

require '../functions - Copy/dbcon.php'; 

function getregcode($lastname) 
{
$getfirst = substr($lastname,0,1);

$completecode = "a";
$datatraineecode = $completecode; 
$num = 0;

$query = "SELECT * 
FROM trainee
WHERE  `lastname` LIKE  '".$getfirst."%'"; 
$mysqldata = mysql_query($query);

$ctn = mysql_num_rows($mysqldata);

while($completecode == $datatraineecode)
{
$num =  $num + $ctn;
$mycodeadd = $getfirst;
$addzero = "000";
if($num <=9) 
{ $addzero = "000";} 
if($num >=10 && $num <=99)
{ $addzero = "00"; }
if($num >=100 && $num <=999) 
{ $addzero = "";}
if($num > 999) 
{ $addzero = ""; } 
$completecode = $mycodeadd . $addzero .$num;

$query = "SELECT * from trainee Where traineecode Like '".$completecode."'";

$mysqldata = mysql_query($query);

if($run = mysql_fetch_assoc($mysqldata))
{
$datatraineecode = $run["traineecode"];
$num = $num + 1;
}


}
return $completecode;

} 


?> 
