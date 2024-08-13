<?php
include 'dbconfig.php';

?>

<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Online Quiz">
    <meta name="author" content="Val Okafor">   
    <title>Invictus - Registration</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="js/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-ui.js"></script>
    <script>

$(function() {
         
$( "#tabs" ).tabs();
var monthNames = $( "#datepick1" ).datepicker( "option", "monthNames" );

$( "#datepick1" ).datepicker("option", "monthNames", ["Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December"]);

    $( "#datepick1" ).datepicker({
        shortYearCuroff: 150,
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
<div class="row" style="padding-left: 30px; padding-right: 30px; margin-top: 0px">
  <h1 style="color: blue; text-align: center;"> Thank you for choosing Invictus!</h1>
   <h2 style="color: black; text-align: center; margin-top:20px">Your Enrollment is now being processed</h2>
     <h2 style="color: black; text-align: center; margin-top:20px">A Copy of invoice will be sent in your email.</h2>
       <h2 style="color: black; text-align: center; margin-top:20px">Thank you!</h2>
     <h3 style="color: blue; text-align: center; margin-top: 50px">"ACHIEVING EXCELLENCE TOGETHER"</h3>
 </div>
