
<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
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


<?php
include 'dbconfig.php';
require 'loadmodules.php'; 
require 'forcookie.php';
$competencenow = $_GET['competence'];

$sessionme =  $_GET['sessionget'];



$fetchqry = "Select * from `invictus_review`.`results` Where viewtype Like '". $_COOKIE['viewtype'] . "' and session Like '". $sessionme . "' and competence Like '". $competencenow. "' and username Like '". $_COOKIE['username'] . "' ORDER BY qno ASC";
$result=mysqli_query($con,$fetchqry);
$num=mysqli_num_rows($result);
@$_SESSION['TOTAL'] = $num; 

@$_SESSION['PERCENT'] = loadcompetencepercent( $_COOKIE['viewtype'], $competencenow);
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
  $i=$row['qno'];
@$userselected = $_POST[$i];

} 
$qry3 = "Select * from `invictus_review`.`results` Where viewtype Like '". $_COOKIE['viewtype'] . "' and session Like '". $sessionme . "' and competence Like '". $competencenow. "' and username Like '". $_COOKIE['username'] . "' ORDER BY qno ASC";
$result3 = mysqli_query($con,$qry3);
while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
    if($row3['answer']==$row3['uranswer'])
    {
	 @$_SESSION['score'] += 1 ;

    }
    else
    {

    }
}
 
 ?> 
 <?php 
 echo "<div class='col-md-offset-2 col-md-8'>";
 echo "<h2>Result: <a href='scores.php'>Return to scores</a></h2>"; 
 echo '<h3>MY SESSION: '. $sessionme . '</h3><br>'; 
 echo "<span><b>No. of Correct Answer:</b>&nbsp;" .  $no = @$_SESSION['score']; 

											//var_dump($_SESSION['ids']);
 //session_unset();  
 echo "</span><br>";

 echo "<span><b>No. of Questions:</b>&nbsp;" . $totalq = @$_SESSION['TOTAL']; 
 
                      //var_dump($_SESSION['ids']);
 //session_unset(); 
 echo "</span><br>";

  echo "<span><b>Passing Rate:</b>&nbsp;". $percentme = @$_SESSION['PERCENT'] . "%"; 
 
                      //var_dump($_SESSION['ids']);
 //session_unset(); 
 echo "</span><br>";
 if(isset($no))
 {
  $totalme = ($no/$totalq) * 100; 
  echo "<span><b>Your Score:</b>&nbsp ". round($totalme) . "%";
 }
 else
 { 
      echo "<span><b>Your Score:</b>&nbsp EMPTY"; 
 }
 echo "</span><br><br>";

 if(isset($no)) 
 {
       if($totalme >=  $percentme)
       {
        echo  "<span><b>RESULT:</b>&nbsp PASSED";
       }
       else 
       {
         echo  "<span><b>RESULT:</b>&nbsp FAILED";
       }
}
echo "</span>";
echo "</div>";


?>
<div class="col-md-offset-2 col-md-8">
<table class="table"> 
    <tr>
    <th> No </th>
    <th> Question </th>
        <th> RESULT </th>
    </tr>

      <?php 

$fetchqry  = "Select * from `invictus_review`.`results` Where viewtype Like '". $_COOKIE['viewtype'] . "' and session Like '". $sessionme . "' and competence Like '". $competencenow. "' and username Like '". $_COOKIE['username'] . "' ORDER BY qno ASC"; 
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
   if($row["status"]=="PASSED")
   {
   echo "<tr style='background-color:LIGHTGREEN;'>"; 
   }
   else
   {
     echo "<tr>"; 
   } 
  
      echo "<td> ". $x . "</td>";
      echo "<td> ". $row["question"] . "</td>"; 
      echo "<td> ". $row["status"] . "</td>"; 
       echo "</tr>"; 

    }
  }

      ?> 
    </table>
  </div>