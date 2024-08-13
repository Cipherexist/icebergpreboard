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

<style>
</style>

<?php  
include 'navbardefault.php';


function loadtotalquestions($viewtype, $competence)
{
  $daf = mysqli_connect('192.168.1.156','naviadmin','navipass','examdb');
  $query = "Select * from preboard Where viewtype Like '". $viewtype. "' and competence Like '". $competence . "'";
    $datame = mysqli_query($daf, $query);
    if(mysqli_num_rows($datame)!=0)
    {
     
      $codecomplete = mysqli_num_rows($datame); 
    }
    
      return $codecomplete;
}

function loadusersession($username, $viewtype)
{
  $daf = mysqli_connect('192.168.1.156','naviadmin','navipass','examdb');
  $query = "Select * from user_data Where username Like '". $username. "' and viewtype Like '". $viewtype . "'";
    $datame = mysqli_query($daf, $query);
    if(mysqli_num_rows($datame)!=0)
    {
     while ($row3 = mysqli_fetch_array($datame, MYSQLI_ASSOC)) {
        $setlimit = 10000;
        setcookie('session',$row3['session'], time()+$setlimit);
            $codecomplete = $row3['session']; 
    }
    }
    
      return $codecomplete;
}

function checkstatus($viewtype, $competence, $percenttotal , $session)
{
  $daf = mysqli_connect('192.168.1.156','naviadmin','navipass','examdb');
  $query = "Select * from `examdb`.`results` Where viewtype Like '".$viewtype . "' and session Like '". $session . "' and competence Like '".$competence. "' and username Like '". $_COOKIE['username'] . "' ORDER BY qno ASC";
    $datame = mysqli_query($daf, $query);
    $corrected = 0;
    $totalme = 0;
    $codecomplete =0;
    if(mysqli_num_rows($datame)!=0)
    {
    $totalme = mysqli_num_rows($datame); 
    while ($row3 = mysqli_fetch_array($datame, MYSQLI_ASSOC)) {
        if($row3['status']=="PASSED")
        {
         $corrected += 1 ;
        }
    }

    }
      if($corrected >0)
      {
        $codecomplete = ($corrected/$totalme) * 100; 
      }

      return $codecomplete;
}


?> 

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1>Preboard Section</h1>
            <div class="form-group">
              <h1> <?php echo $_COOKIE['viewtype']; ?> </h1>
  </div>
  
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">Set</button>

        </form>
    </div>
     </div>
	 <?php if(isset($_POST['submit'])){
$fetchqry = "SELECT * FROM `quiz`";
$result=mysqli_query($con,$fetchqry);
$num=mysqli_num_rows($result);
@$id = $num + 1;
@$que = $_POST['question'];
@$ans = $_POST['correct_answer'];
@$wans1 = $_POST['wrong_answer1'];
@$wans2 = $_POST['wrong_answer2'];
@$wans3 = $_POST['wrong_answer3']; 
$qry = "INSERT INTO `quiz`(`id`, `que`, `option 1`, `option 2`, `option 3`, `option 4`, `ans`) VALUES ($id,'$que','$ans','$wans1','$wans2','$wans3','$ans')";
$done = mysqli_query($con,$qry);
if($done==TRUE){
	echo "Question and Answers Sumbmitted Succesfully";
}
	 }
?>
<div class="row" style="margin-top:20px">
    <div class="col-md-offset-2 col-md-8">
      <h1>Session: <?php echo $usersession = loadusersession($_COOKIE['usname'], $_COOKIE['viewtype']); ?>  
</h1>
	<table class="table"> 
    <tr>
    <th> No </th>
    <th> Competence </th>
       <th> Quiz Items </th>
        <th> Passing Grade </th>
          <th> status </th>
    </tr>

      <?php 

$fetchqry  = "SELECT * FROM `competence` WHERE VIEWTYPE LIKE '".  $_COOKIE['viewtype'] ."'"; 
  $datame1 = mysqli_query($con,$fetchqry);
  $numrows=mysqli_num_rows($datame1);
  $x = 0; 
  $proceedend = 0; 


  if($numrows!=0)
  {
    while($row = mysqli_fetch_assoc($datame1))
    {
      //  setcookie('username', $row["username"], time()+$setlimit);
      //  setcookie('viewtype', $row["viewtype"], time()+$setlimit);
//setcookie('completename', $row["completename"], time()+$setlimit);
   $x = $x +1; 
    echo "<tr>"; 
      echo "<td> ". $x . "</td>";
      echo "<td> ". $row["STATUS"] . "</td>"; 
        echo "<td> ". $row["CONTENTS"] . "</td>"; 
          echo "<td> ". $row["PERCENTAGE"]. "%" . "</td>"; 
          $myresult = checkstatus($row["VIEWTYPE"], $row["COMPETENCE"] , $row["PERCENTAGE"] , $usersession);
          if ($myresult >0)
          {
            if($myresult >=$row["PERCENTAGE"])
            {
                  $proceedend +=1; 
                 echo "<td>  <a href='quiz.php?competence=".$x."&qn=". $row["CONTENTS"] ."' style='text-decoration:none'>". $myresult . "% PASSED (RETAKE?)</td>";
            }
            else
            {
                $proceedend +=1; 
               echo "<td>  <a href='quiz.php?competence=".$x."&qn=". $row["CONTENTS"] ."' style='text-decoration:none'>". $myresult . "% FAILED (RETAKE?)</td>";
            }
      
           }
           else 
           {
              echo "<td>  <a href='quiz.php?competence=".$x."&qn=". $row["CONTENTS"] ."' style='text-decoration:none'>Start </a></td>";
          
           }
   echo "</tr>"; 
    }
    if($proceedend==$numrows)
    {
       $daf = mysqli_connect('192.168.1.156','naviadmin','navipass','examdb');
       $countme = 0; 
       $countme =  $_COOKIE['session'] + 1; 

     $fetchqry2 = "UPDATE `user_data` SET `session`='".$countme ."' WHERE viewtype Like '". $_COOKIE['viewtype'] . "' and username Like '". $_COOKIE['username'] . "'"; 
     if(mysqli_query($daf,$fetchqry2))
     {
        
        echo 'Your session is ended, restart to proceed next session';
     }
     else
      {
         echo mysqli_error("ERROR:" . $daf) ;
      }
    }
    else 
    {
   echo 'Your session is ongoing';
    }
  }

      ?> 






    </table>


</div></div>
<?php
if(isset($_POST['timesubmit'])){
@$min = $_POST['min'];
@$sec = $_POST['sec'];
$timer = $min.':'.$sec;
$fetchqry3 = "UPDATE `quiz` SET `timer`='$timer' WHERE`id`=1";
$result3 = mysqli_query($con,$fetchqry3);
if($result3==TRUE){
	echo "The timer currently set to $timer";
}
}
?>