<?php
include 'dbconfig.php';
require 'forcookie.php';
require 'loadmodules.php'; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Online Quiz">
    <meta name="author" content="Val Okafor">   
    <title>Simple Quiz</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

<?php  
include 'navbardefault.php';

?> 


 <div class="col-md-offset-2 col-md-8">
<h2>Competence <?php echo $_GET['competence']; ?>: <a href="preboard.php">Click to Return</a></h2>
 <h1><?php echo loadcompetencename($_COOKIE['viewtype'], $_GET['competence']); ?></h1><br>
</div>

<div class="col-md-offset-2 col-md-8">
<table class="table"> 
    <tr>
    <th> No </th>
    <th> Question </th>
     <th> Answer </th>
       <th> History </th>
    </tr>

      <?php 

$fetchqry  = "Select * from `examdb`.`preboard` Where viewtype Like '". $_COOKIE['viewtype'] . "' and competence Like '". $_GET['competence']. "' ORDER BY QUESTION ASC"; 
  $datame1 = mysqli_query($con,$fetchqry);
  $numrows=mysqli_num_rows($datame1);
  $x = 0; 

  if($numrows!=0)
  {
    while($row = mysqli_fetch_assoc($datame1))
    {
      //  setcookie('username', $row["username"], time()+$setlimit);
      //  setcookie('viewtype', $row["viewtype"], time()+$setlimit);
//setcookie('completename', $row["completename"], time()+$setlimit);
   $x = $x +1;
    $status = loadlastresult($_COOKIE['viewtype'], $_GET['competence'], $_COOKIE['usname'], $row["QUESTION"] ); 

    if($status=="PASSED")
    {
      echo "<tr style='background-color:LIGHTGREEN;'>";  
    }
    else if ($status=="FAILED") {
      # code...
      echo "<tr style='background-color:ORANGE;'>"; 
    }
    else
    {
      echo "<tr>"; 
    }
   
      echo "<td> ". $x . "</td>";
      echo "<td> ". $row["QUESTION"] . "</td>"; 
      echo "<td> ". $row["C1"] . "</td>"; 
       echo "<td> ". $status . "</td>";
       echo "</tr>"; 

    }
  }

      ?> 
    </table>
  </div>