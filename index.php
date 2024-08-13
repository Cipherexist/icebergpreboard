

<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Iceberg Maritime Online preboard">
    <meta name="author" content="Val Okafor">   
    <title>Simple preboard</title>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css'>
        <!--
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <script src='js/jquery.min.js'></script>
        <script src='js/bootstrap.min.js'></script>
        <script src='js/jquery.js'></script>
        <script src='js/jquery-1.10.2.js'></script>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        -->
         <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js'></script> 	
         <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
  </head>

<style>
</style>


<?php
require 'dbconfig.php';
require 'forcookie.php';
//require 'loadmodules.php'; 
require 'modules.php'; 
include 'loadfunction2.php';

if(!empty($_COOKIE['usname']))
{ 
@$myusername = $_COOKIE['usname'];
@$globelviewtype = $_COOKIE['viewtype'];    
//echo 'PASOK'. $_COOKIE['viewtype'];
}
else 
{
    echo '<script>window.location.replace("login.php");</script>';
}

@$sessionme =  loadmysession($myusername); 

@$overallpassed = 0; 
@$overallitems = 0; 
@$overallpercentage = 0; 
@$numrows=0;
@$proceedend = 0; 
@$globaldate = loadregistrationdatetoday(); 
@$globaltime = loadregistrationtime();


if(!empty($_COOKIE['usname']))
{ 
    $mysqlme = "INSERT INTO `preboardlogs` (`username`,`dateaccess`,`timeaccess`) VALUES ('$myusername','$globaldate','$globaltime')"; 
    mysqli_query($con,$mysqlme); 
    if(mysqli_error($con))
    {
        echo mysqli_error($con);
    }
}




?>


<?php  
include 'navbardefault.php';




?> 


<script type="text/javascript">

function endsession(theusername,theviewtype)
{

  Swal.fire({
    title: 'Do you want to End your session?:',
    showDenyButton: true,
    icon: 'warning',
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    denyButtonText: `End Session`,
    confirmButtonText: `Continue`,
    }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed)
    {
    

    } 
    else if (result.isDenied) 
    {
      
    //  alert("Session Ended!");
    try {
      
      $.post("ssincrease.php",
            {
              ssusername:theusername,
              ssviewtype:theviewtype
            },function(result){
             // alert(result);
                  if(result==1)
                  {
                    alert("Session Ended!");
                   location.reload();
                  }
                  else 
                  {
                    alert(result); 
                  }




            });
    } catch (error) {
      alert(error);
    }
            
    
    }
    }); 
}


function loadalltables()
{
  try {
    //alert("pasok");
    $('#ajaxloading2').show();     
      $.post("maintable.php",{
      },function(result)
      {
        $('#ajaxloading2').hide();     
        $('#resultall').empty();
        $('#resultall').append(result);
      }); 
  } catch (error) {
    alert(error);
  }
 


}

$(document).ready(function() 
 {
  $('#ajaxloading2').hide();     
  try {
    loadalltables();
  } catch (error) {
    alert(error);
  }
 

});




</script>



<div class="container">
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h3>Preboard Section</h3>
            <div class="form-group">
              <h3> <?php echo $globelviewtype; ?> </h3>
              <p class='text-danger'>Please be aware that accessing online and accessing mobile phone at the same time (or exactly at the same time) is subject for violation and termination of online account (ONLINE ACCOUNT ONLY). please don't use your account in mobile phone while accessing the online access.</p>
  </div>
  
  <?php 
        @$resetusername = '"'. $_COOKIE['usname'] . '"'; 
        @$resetclassno = '"'. $_COOKIE['viewtype'] . '"';

       //  echo "<button type='submit' class='btn btn-primary btn-large' value='submit' name='submit' onclick='endsession($resetusername,$resetclassno)'>End your session</button>"; 


  ?>
        </form>
    </div>
     </div>



<div class="row" style="margin-top:20px">
     </h1>
     
	<table class="table table-bordered"> 
    <thead>
    <tr>
    <th> C No </th>
    <th> Competence Title </th>
     <th> Total Questions </th>
       <th> preboard Items </th>
        <th> Passing Grade </th>
          <th> status </th>
   <!--      <th> MacExam </th> -->
    </tr>
    </thead>
    <tbody id="resultall">

      <p id="ajaxloading2"><img src="image/ajax-loader.gif"/>Loading Data</p>
   

    </tbody> 

    </table>

</div>

</div>