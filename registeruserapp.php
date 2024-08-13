<?php
include 'dbconfig.php';
require 'forcookie.php';
require 'forcookie2.php';
include 'navbardefault.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Online Quiz">
    <meta name="author" content="Val Okafor">   
    <title>Invictus - App Userz</title>

    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    
    <!--
    <link href="css/theme.css" rel="stylesheet">
   	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   	<link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
   	-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
  <!--
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery-1.10.2.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>






<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>

$(function() {
         
$( "#tabs" ).tabs();
var monthNames = $( "#datepick1" ).datepicker( "option", "monthNames" );

$( "#datepick1" ).datepicker("option", "monthNames", ["Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December"]);

    $( "#datepick1" ).datepicker({
        shortYearCuroff: 50,
         changeMonth: true,
         changeYear: true
        });
        
$("#datepick1").datepicker().datepicker("setDate", new Date());
  $("#datepick2").datepicker().datepicker("setDate", new Date());
        
var monthNames2 = $( "#datepick2" ).datepicker( "option", "monthNames" );

$( "#datepick2" ).datepicker("option", "monthNames2", ["Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December"]);

    $( "#datepick2" ).datepicker({
            shortYearCuroff: 50,
         changeMonth: true,
         changeYear: true
        });
    $( "#submitnow" ).button();
  });
  
  
function scheduleme(classnotext) 
{   
   document.getElementById("result").innerHTML = "<div class='row' id='backcolorstyle' style='margin-top:10px; color:black; text-align:center; padding: 10px 10px 10px 10px;'>  Please Wait While We Load your Request, It Will take less than 10 minutes to load. </div>"
var viewallnew  = "Not Checked"; 
var viewapproved = "Not Checked"; 

if ($("#newclientscheckbox").is(":checked")) {
  viewallnew = "Checked";
}

if ($("#newapprovedclient").is(":checked")) {
  viewapproved = "Checked";
}

 
    $.post("clientstatusload.php",
    {
    fdate: $("#datepick1").datepicker({dateFormat:'dd-MM-yyyy'}).val(),
    vcheckbox1: viewallnew,
    vcheckbox2: viewapproved,
    ldate: $("#datepick2").datepicker({dateFormat:'dd-MM-yyyy'}).val()
    },function(result){
            $('#result').empty();
            $('#result').append(result);
        
    });
} 

function loadevents(agencycode, monthof) 
{ 
    $.post("marketingevents.php",
    {
    mdate: monthof,
    agcode: agencycode
    },function(result){
            $('#result2').empty();
            $('#result2').append(result);   
    });
} 

 
  

  </script>
  </head>


<style>
</style>


<div class="container">
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1>Register Application User</h1>
        <form action="" method="post">
            
                   <div class="form-group margin-top: 10px;">
           <label for="accesstype">Select Question Limit</label>
          <select class="form-control" id="controlstatus" name="controlstatus" style="font-weight: bold; color:#000;">
   <option class="form-control" value="80">80%</option>
    <option class="form-control" value="100">100%</option>
	<option class="form-control" value="trial">trial</option>
  </select> 
  </div>
            
            <div class="form-group">
                <label for="completename">Complete name</label>
                <input type="text" class="form-control" id="question" name="completename" placeholder="Enter your CompleteName here" Required>
            </div>
            <div class="form-group">
                <label for="username">Username (Optional)</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter the Username here" Required>
            </div>
            <div class="form-group">
                <label for="password">Activation Code</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="Your Activation Code" Required>
            </div>


             <div class="form-group">
           <label for="datepick1">Select Exam Date</label>
          <input type="text" class="form-control" id="datepick1" name="datepick1" placeholder="Enter the Exam Date" Required>
          </div>

     <div class="form-group">
           <label for="viewtype">Select Type</label>
          <select class="form-control" id="coursename" name="viewtype" style="font-weight: bold; color:#000;">

   <option class="form-control" value="Deck Management Level"> Deck Management Level</option>
    <option class="form-control" value="Engine Management Level"> Engine Management Level</option>
     <option class="form-control" value="Deck Operational Level"> Deck Operational Level</option>
      <option class="form-control" value="Engine Operational Level"> Engine Operational Level</option>
  </select> 
  </div>

     <div class="form-group">
           <label for="accesstype">Select Access</label>
          <select class="form-control" id="accesstype" name="accesstype" style="font-weight: bold; color:#000;">
   <option class="form-control" value="Exam and Preview">Exam and Preview</option>
    <option class="form-control" value="Review Only">Review Only</option>
	<option class="form-control" value="Review Only">Exam Only</option>
  </select> 
  </div>
  

  
       <div class="form-group">
           <label for="usertype">Select User Type</label>
          <select class="form-control" id="usertype" name="usertype" style="font-weight: bold; color:#000;">
   <option class="form-control" value="Trainee User">Trainee User</option>
    <option class="form-control" value="Administrator">Administrator</option>
  </select> 
  </div>
  
         <div class="form-group">
           <label for="expirymonths">Select Expiry Months</label>
          <select class="form-control" id="expirymonths" name="expirymonths" style="font-weight: bold; color:#000;">
   <option class="form-control" value="Never">Never</option>
    <option class="form-control" value="1">1</option>
	 <option class="form-control" value="2">2</option>
	  <option class="form-control" value="3">3</option>
	   <option class="form-control" value="4">4</option>
	    <option class="form-control" value="5">5</option>
		 <option class="form-control" value="6">6</option>
		  <option class="form-control" value="7">7</option>
		   <option class="form-control" value="8">8</option>
		    <option class="form-control" value="9">9</option>
			 <option class="form-control" value="10">10</option>
			  <option class="form-control" value="11">11</option>
			   <option class="form-control" value="12">12</option>
  </select> 
  </div>
            <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">Submit Details</button>


        </form>
    </div>
     </div>
     
     
     </div>
     
 <?php if(isset($_POST['submit'])){
	 $con2 = mysqli_connect('localhost','invictus_user','N@vigator00000','invictus_review');
$fetchqry = "SELECT * FROM `examapproved`";
$result=mysqli_query($con2,$fetchqry);
$num=mysqli_num_rows($result);
@$id = $num + 1;
@$que = $_POST['completename'];
@$ans = $_POST['password'];
@$wans1 = $_POST['completename'];
@$wans2 = $_POST['viewtype'];
@$wans3 = 'yes'; 
@$wans4 = $_POST['accesstype'];
@$wans5 = $_POST['usertype'];
@$wans6 = $_POST['expirymonths'];
@$examdate = $_POST['datepick1']; 
@$today = date("F j, Y, g:i a");
@$creator = $_COOKIE['usname'];
@$contolstatus =  $_POST['controlstatus'];
@$sessionme = '1'; 
$qry = "INSERT INTO `examapproved`(`usernameusage`, `password`, `completename`, `viewtype`, `access`, `examdate`, `session` , `accessuser`, `usertype`, `expirymonths`, `status`, `accesstype`, `rights`, `datecreated`, `createdby`, `controlstatus`) VALUES ('$que','$ans','$wans1','$wans2','$wans3','$examdate','$sessionme', '$wans4', '$wans5', '$wans6', 'yes', '$wans2', 'user', '$today', '$creator', '$contolstatus')";
$done = mysqli_query($con2,$qry);
if($done==TRUE){
    echo "<script> swal('Regisration Successfull!', 'You can now use Activation: @$ans', 'success'); </script>";
}
else 
{
    echo "ERROR: Could not able to execute.". mysqli_error($con2) ;
}
     }
?>
