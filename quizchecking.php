<?php

use GrahamCampbell\ResultType\Result;

include 'dbconfig.php'; 
include 'modules.php'; 
include 'loadfunction2.php';


@$classnoglobal = $_POST['classnumber'];
@$mycompetence = $_POST['thecompetence'];



$totalslides = 50;
loadquizfirsttime($classnoglobal,$mycompetence);
echo 1; 
     
       


?> 




