<?php 
if(!empty($_COOKIE['usname']) && !empty($_COOKIE['psword'])){ 
//echo $_COOKIE['usname'];
//echo $_COOKIE['psword'];

$sname = rtrim(ltrim(trim($_COOKIE['usname'])));

$pword = $_COOKIE['psword'];
require 'dbconfig.php';

    $fetchqry  = "SELECT * FROM `examapproved` WHERE email LIKE '". $sname ."' AND password LIKE '". $pword ."' and onlineactivated Like 'yes'"; //SQL FORMAT FOR SEARCHING 

    if($sname!="")
    {
        $result=mysqli_query($con,$fetchqry);
        $num_row=mysqli_num_rows($result);
    
        if(!mysqli_error($con))
        {
            if ($num_row != 0) 
            {
        
            } 
            else 
            {
            echo '
            <script> 
            window.location.replace("login.php");</script> 
            ';	
            }
        
            }
            else 
            { 
            echo '
            <script> 
            window.location.replace("login.php");
            </script> 
            ';	
            } 
        }
        else 
        {
            echo mysqli_error($con);
        }
  
    }



?> 


