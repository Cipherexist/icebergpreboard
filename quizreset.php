<?php 
include 'dbconfig.php'; 

@$myviewtype = $_POST['rsviewtype']; 
@$mycompetence = $_POST['rscompetence']; 
@$mysession = $_POST['rssession']; 
@$username = $_COOKIE['usname']; 

@$sqlme =  "DELETE from `onlineresults` Where username Like '$username' and course Like '$myviewtype' and competence Like '$mycompetence' and session Like '$mysession'"; 

$dba = mysqli_query($con,$sqlme); 

if (!mysqli_error($con))
{
        echo 1; 
}
else 
{
    echo mysqli_error($con); 
}

?>

