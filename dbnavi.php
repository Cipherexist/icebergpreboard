<?php 

$sqlhost = '119.93.9.252';
//$sqlhost = 'localhost'; 
if (isset($_COOKIE['branchcode']))
{ 

if ($_COOKIE['branchcode']=='NAVI-1')
{

$mysql_user  = 'navigato_admin';
$mysql_pass = 'N@vigator00000';
$mysql_db = 'navigato_gpnmonitor';
}
else if($_COOKIE['branchcode']=='NAVI-2')
{ 
$mysql_user  = 'navigato_admin';
$mysql_pass = 'N@vigator00000';
$mysql_db = 'navigato_gpnmonitor';
}
}
else
{ 
//$mysql_user  = 'navigato_admin';
//$mysql_pass = 'N@vigator00000';
//$mysql_db = 'navigato_gpnmonitor';	
$mysql_user  = 'servercon';
$mysql_pass = 'navisys2015';
$mysql_db = 'review_ice';		
}
$mysql_db = 'review_ice';		
$con = mysqli_connect($sqlhost, $mysql_user , $mysql_pass, $mysql_db) or die('connection server error');


?> 
