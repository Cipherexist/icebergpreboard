<?php
include 'dbconfig.php';
require 'forcookie.php';
require 'loadmodules.php'; 

        
     
      $usernameme = $_POST['usernameme'];
      $fetchqry2 = "UPDATE `examapproved` SET `controlstatus` = 'trial', `password` = '', `status` = 'no' WHERE `usernameusage` Like '".$usernameme. "'"; 
      mysqli_query($con,$fetchqry2);
  


      if(!mysqli_error($con))
         {
           
            echo include 'showandroiduser.php';
         }
         else 
         {
            echo mysqli_error($con) ;

         }



      

?>