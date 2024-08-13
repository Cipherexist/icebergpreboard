<?php 

include 'dbconfig.php'; 
require 'forcookie.php';
require 'loadmodules.php'; 
require 'forcookie2.php';

@$myid = $_POST['myid']; 
@$password = $_POST['mycode'];
@$payment = $_POST['mypayment'];


echo $payment; 

if($password !="" && $payment !="")
{

    $mysqlme  = "UPDATE `examapproved` SET `password`='$password', `status`='yes', `controlstatus`='100', `purchase`='yes', `marketby`='$payment' WHERE ID Like '$myid'";
    mysqli_query($con,$mysqlme); 


    if(!mysqli_error($con))
    {
    echo include 'showandroiduser.php';
    }
    else 
    {
        echo 2; 

    }
}
else 
{
    echo 1; 
}
    ?> 


