<?php
include 'dbconfig.php';
require 'forcookie.php';
require 'loadmodules.php'; 

      
echo 
     '<div id="result" class="row" style="margin-top:20px">';

      $con2 = mysqli_connect('localhost','invictus_user','N@vigator00000','invictus_review');
      $usernameme = $_POST['usernameme'];
      $fetchqry2 = "UPDATE `examapproved` SET `hide` = 'yes', `status` = 'no', `controlstatus` = '100' WHERE `usernameusage` Like '".$usernameme. "'"; 
      if(mysqli_query($con2,$fetchqry2))
      {
          
      }
        else
      {
         echo mysqli_error($con2) ;
      }
      $fetchqry2 = "UPDATE `examuseraccess` SET `active` = 'no' WHERE `username` Like '" .$usernameme. "'"; 
      if(mysqli_query($con2,$fetchqry2))
      {
          
      }
      else
      {
         echo mysqli_error($con2) ;
      }   
      
    echo '	<script> 
    window.location.replace("icebergapp.php");
    </script> 
	';
      

?>