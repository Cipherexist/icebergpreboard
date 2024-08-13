<?php 

$sqlhost = 'localhost';
//$sqlhost = 'localhost'; 

//$mysql_user  = 'navigato_admin';
//$mysql_pass = 'N@vigator00000';
//$mysql_db = 'navigato_gpnmonitor';	
$mysql_user  = 'icebergm_admin';
$mysql_pass = 'N@vigator00000';
$mysql_db = 'icebergm_review';			
$con = mysqli_connect($sqlhost, $mysql_user , $mysql_pass, $mysql_db) or die('connection server error');


?> 
