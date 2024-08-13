<?php 

ob_start();
function loaduseraccesstype($username)
{
	include 'dbconfig.php';
    $query = "Select * from `examapproved` Where email Like '". $username. "'";
    $datame = mysqli_query($con, $query);
    if(mysqli_num_rows($datame)!=0)
    {
      while($row = mysqli_fetch_assoc($datame)) 
      {
      $codecomplete = "User"; 
      }
    }
    else
    {
      $codecomplete = $query; 
    }
    
      return $codecomplete;
}



$huan = $_POST['usname'];
$two = $_POST['psname'];
$setlimit = 10000;




//setcookie('usname', $huan, time()+$setlimit);
//setcookie('psword', $two, time()+$setlimit);


require 'dbconfig.php';


if($_POST['usname']!="" && $_POST['psname']!="")
 {
    @$huan = str_replace("'",'',$_POST['usname']);
    @$two = str_replace("'",'',$_POST['psname']);
	 $usnameme = 'admin'; 
	 $psnameme = '24428142258';
	 
	 
$fetchqry  = "SELECT * FROM `examapproved` WHERE email LIKE '". $huan ."' AND password LIKE '". $two ."'"; //SQL FORMAT FOR SEARCHING 

$result=mysqli_query($con,$fetchqry);
$numrows=mysqli_num_rows($result);

	 if($numrows != 0) 
	 {
    @$myactivation = ""; 

	$datame1 = mysqli_query($con,$fetchqry);
	$numrows=mysqli_num_rows($datame1);
	if($numrows!=0)
	{
        
		while($row = mysqli_fetch_assoc($datame1))
		{
            $myactivation = $row["onlineactivated"];
			if($row["access"]=="yes")
			{
			setcookie('usname', $huan, [
            'expires' => time()+$setlimit,
            'samesite' =>'Lax'
            ]);
        
            setcookie('psword', $two, [
            'expires' => time()+$setlimit,
            'samesite' =>'Lax'
            ]);
		
			
			setcookie('viewtype',  $row["viewtype"], [
            'expires' => time()+$setlimit,
            'samesite' =>'Lax'
            ]);
            
           	setcookie('username',  $row["email"], [
            'expires' => time()+$setlimit,
            'samesite' =>'Lax'
            ]);
            
            setcookie('completename',  $row["usernameusage"], [
            'expires' => time()+$setlimit,
            'samesite' =>'Lax'
            ]);
            
            setcookie('session',  $row["session"], [
            'expires' => time()+$setlimit,
            'samesite' =>'Lax'
            ]);
            
            setcookie('accesstype', "User", [
            'expires' => time()+$setlimit,
            'samesite' =>'Lax'
            ]);
            
            setcookie('oldsystem', $row["oldsystem"], [
            'expires' => time()+$setlimit,
            'samesite' =>'Lax'
            ]);
            
			}
	
			
			
			else
			{
					echo '  <p style="color:#F66; font-family:"Copperplate Gothic Bold""> Sorry, Your Access has been denied by the Administrator, Due to the reason that your access is expired.</p>';
					die();
			}
		}
        if($myactivation=="yes")
        {
            echo 2;
        }
        else 
        {
            echo 1;
        }

		 
    //    echo '  <p class="text-danger"> Service Unavailable, Due to our system is only available on On-site visit only</p>';

	}
	
	 }
	 else 
	 { 
	 echo '  <p style="color:#F66; font-family:"Copperplate Gothic Bold""> Login-details incorrect </p>';
	 } 
	 
 }
 else 
 {
	echo '  <p style="color:#F66; font-family:"Copperplate Gothic Bold"">Please input your Credentials</p>';
 }

ob_end_flush();
?>
   
      