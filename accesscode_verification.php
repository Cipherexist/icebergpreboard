<?php 
require 'dbconfig.php';

@$passcode =  $_POST['passcode'];
@$myusername = $_COOKIE['usname'];

$mysql = "Select * from examapproved Where email Like '$myusername' and otp Like '$passcode'";
$dbt = mysqli_query($con,$mysql); 

if (!mysqli_error($con))
{

    if(mysqli_num_rows($dbt)!=0)
    {
      $updatesql = "UPDATE `examapproved` set onlineactivated='yes' Where email Like '$myusername'";
      mysqli_query($con,$updatesql); 
      if(!mysqli_error($con))
      {
            echo 1;
      }
      else 
      {
        echo mysqli_error($con);
      }

    }
    else 
    {
        echo "One Time password Expired";
    }
}
else 
{
    echo mysqli_error($con);
}





?>