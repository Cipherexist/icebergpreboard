<!DOCTYPE html>
<html>
<?php 
require 'dbconfig.php';
require 'forcookie.php';
$setlimit = 10000;
//setcookie("competence", $_GET['competence'], time()+$setlimit);

require 'loadmodules.php'; 

$fetchqry2 = "UPDATE `invictus_review`.`user_data` SET `competence`='". $_GET['competence'] ."' WHERE username Like '". $_COOKIE['username'] .  "'"; 
 if(mysqli_query($con,$fetchqry2))
            {

            }
            else 
            {
              echo "ERROR: Could not able to execute.". mysqli_error($con) ;
            }

//setcookie("competence", $_GET['competence'], time()+$setlimit, '/');

session_start();
 ?>

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
	<link rel="stylesheet" href="css/index.css">	
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

<?php  
include 'navbardefault.php';
//setcookie("competence",  $_GET['competence'], , '/');

?> 


<head>
<title>Technopoints Quiz</title>
</head>
<body onload="hidder();">
<center>
<div class="time row" id="navbar">Time left :<span id="timer"></span></div>
<button class="button" id="mybut" onclick="myFunction()">START QUIZ</button>
</center>
<div id="myDIV" style="padding: 10px 30px;">
<form action="result.php"  method="post" id="form">  				
 
<table class="table"><?php   $fetchqry = "SELECT * FROM `invictus_review`.`quiz` Where viewtype Like '". $_COOKIE['viewtype']. "' and competence Like '". $_GET['competence']. "' ORDER BY rand() ";
// <table class="table"><?php   $fetchqry = "SELECT * FROM `invictus_review`.`quiz` Where viewtype Like '". $_COOKIE['viewtype']. "' and competence Like '". $_GET['competence']. "' ORDER BY rand() LIMIT ". $_GET['qn'];		
      // 	$setlimit = 10000;
       // setcookie('competence', $_GET['competence'], time()+$setlimit);
        
      	$result=mysqli_query($con,$fetchqry);
				$num=mysqli_num_rows($result);
		    loadcheckifexamexist($_COOKIE['session'],$_COOKIE['viewtype'],$_GET['competence'],$_COOKIE['username']); 
		    $d=mktime(11, 14, 54, 8, 12, 2014);
            $mysessionme = "";
            $mysessionme =  date("Y-m-d-H:i:s");
		    $countingto = 0;
		    $mycounttotal = 0; 
		    $mycounttotal = $_GET['qn'];
		    $myqme = "INSERT INTO `invictus_review`.`sessiontime` (`VIEWTYPE`, `COMPETENCE`, `TOTALANS`, `TOTALFAIL`, `TOTALQ`, `AVERAGE`, `USERNAME`, `DATEANDTIME`) VALUES ('". $_COOKIE['viewtype'] . "', '" . $_GET['competence'] . "', '', '', '', '', '". $_COOKIE['username'] . "', '".  $mysessionme ."')";
		    
		    	   if(mysqli_query($con,$myqme))
                     {

                     }
                     else 
                     {
                       echo "ERROR: Could not able to execute.". mysqli_error($con) ;
                     }
            
			   while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
			   {
			    
			      if($countingto >= $mycounttotal)
			       {
			            break ;
			       }
			       
				   $myresultme = loadcheckedifpassed($row['VIEWTYPE'], $row['COMPETENCE'] , $row['QUESTION'] , $_COOKIE['username']);
				   if($myresultme=="FAILED")
				   {
				      $countingto +=1;   
				   
				   
		  ?>
  <tr><td><h3><br><?php echo @$snr = @$snr + 1;  @$my_array = array("C1","C2","C3","C4");
shuffle($my_array);


				   $myquery = "INSERT INTO `invictus_review`.`results` (`competence`, `viewtype`, `question`, `username`, `session`, `answer`, `qno`) VALUES ('". $row['COMPETENCE']."', '".$row['VIEWTYPE']."', '".$row['QUESTION']."', '". $_COOKIE['username'] ."', '". $mysessionme ."', '".$row['C1']."', '". $snr . "')"; 
				   
				   if(mysqli_query($con,$myquery))
                     {

                     }
                     else 
                     {
                      // echo "ERROR: Could not able to execute.". mysqli_error($con) ;
                         }
            
            
            
				   



?>&nbsp;-&nbsp;<?php echo @$row['QUESTION'];?></h3></td></tr>

  <tr><td >&nbsp;&nbsp;&nbsp;&nbsp;a )&nbsp;&nbsp;&nbsp;<input required type="radio" name="<?php echo $snr;?>" value="<?php echo $row[$my_array[0]];?>">&nbsp;<?php echo $row[$my_array[0]]; ?><br>
  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;b )&nbsp;&nbsp;&nbsp;<input required type="radio" name="<?php echo $snr;?>" value="<?php echo $row[$my_array[1]];?>">&nbsp;<?php echo $row[$my_array[1]];?></td></tr>
  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;c )&nbsp;&nbsp;&nbsp;<input required type="radio" name="<?php echo $snr;?>" value="<?php echo $row[$my_array[2]];?>">&nbsp;<?php echo $row[$my_array[2]]; ?></td></tr>
  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;d )&nbsp;&nbsp;&nbsp;<input required type="radio" name="<?php echo $snr;?>" value="<?php echo $row[$my_array[3]];?>">&nbsp;<?php echo $row[$my_array[3]]; ?><br><br><br></td></tr>
			    <?php 
			    
			       
			       
			       
			    
			         }
			         
			     

			   } //END OF WHILE    
																	?> 
		<tr><td align="center"><button class="button3" name="click" >Submit Quiz</button></td></tr>
	</table>
  <form>
</div>
<script>
function myFunction() {
	var x = document.getElementById("myDIV");
    var b = document.getElementById("mybut");
    var x = document.getElementById("myDIV");
	if (x.style.display === "none") { 
	b.style.visibility = 'hidden';
	x.style.display = "block";
	startTimer();
}
}
window.onload = function() {
  document.getElementById('myDIV').style.display = 'none';
};
</script>
<?php			$fetchqry = "SELECT * FROM `invictus_review`.`quiz`  Where viewtype Like '". $_COOKIE['viewtype']. "' and competence Like '". $_GET['competence']. "' LIMIT ". $_GET['qn'];
			  $datame1 = mysqli_query($con,$fetchqry);
  $numrows=mysqli_num_rows($datame1);
				$settime = $numrows . ":00";		
						?>
 <script type="text/javascript">

document.getElementById('timer').innerHTML = '<?php echo $settime; ?>';
  //03 + ":" + 00 ;


function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  if(m==0 && s==0){document.getElementById("form").submit();}
  document.getElementById('timer').innerHTML =
    m + ":" + s;
  setTimeout(startTimer, 1000);
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
  if(sec == 0 && m == 0){ alert('stop it')};
}
</script>

<script>
window.onscroll = function() {myFun()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop -50;

function myFun() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>

</body>
</html>

