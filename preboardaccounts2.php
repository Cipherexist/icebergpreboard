<?php
include 'dbconfig.php';
require 'forcookie.php';
require 'loadmodules.php'; 
require 'forcookie2.php';
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

  </head>

<style>
</style>


<script>
    
  function deleteme(classnotext) 
{ 

swal.fire({
  title: 'Delete ' + classnotext + '?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
    
    
    $.post("deleteacctpreboard.php",
	{
	usernameme: classnotext
	},function(result){
	    swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
			$('#result').empty();
			$('#result').append(result);
		
	});
  }
});

}   
    
    
    
</script>

<?php  
include 'navbardefault.php';


function loadtotalquestions($viewtype, $competence)
{
  $daf = mysqli_connect('localhost','invictus_user','N@vigator00000','invictus_review');
  $query = "Select * from preboard Where viewtype Like '". $viewtype. "' and competence Like '". $competence . "'";
    $datame = mysqli_query($daf, $query);
    if(mysqli_num_rows($datame)!=0)
    {
     
      $codecomplete = mysqli_num_rows($datame); 
    }
    
      return $codecomplete;
}

function lastlogin($usernameme)
{
  $daf = mysqli_connect('localhost','invictus_user','N@vigator00000','invictus_review');
  $query = "Select * from examuseraccess Where username Like '". $usernameme. "'";
    $datame = mysqli_query($daf, $query);
    if(mysqli_num_rows($datame)!=0)
    {
     while ($row3 = mysqli_fetch_array($datame, MYSQLI_ASSOC)) {
        
      $codecomplete = $row3['lastlogin']; 
     }
    }
    
      return $codecomplete;
}

function loadusersession($username, $viewtype)
{
  $daf = mysqli_connect('localhost','invictus_user','N@vigator00000','invictus_review');
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
  $daf = mysqli_connect('localhost','invictus_user','N@vigator00000','invictus_review');
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
<div class="container">
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
          <h1>Preboard Accounts</h1>
               <div class="form-group">
           </div>
            </form>
        </div>
        </div>
        
        
<div id="result" class="row" style="margin-top:20px">
    <div class="col-md-offset-2 col-md-8">
    </h1>
	<table class="table"> 
    <tr>
    <th> No </th>
    <th> Completename </th>
    <th> Username </th>
       <th> Password </th>
     <th> Account Type </th>
     <th> Review For </th>
   <th> Last Login </th>
	 <th> FUNCTION </th>
    </tr>

      <?php 
  $con2 = mysqli_connect('localhost','invictus_user','N@vigator00000','invictus_review');
  $fetchqry  = "SELECT * FROM `invictus_review`.`user_data` Where access Like 'yes'"; 
  $datame1 = mysqli_query($con2,$fetchqry);
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
   if($row["accesstype"]=='Admin')
   {
	   echo "<tr style='background-color:LIGHTGREEN;'>"; 
   }else
   {
	   echo "<tr style='background-color:YELLOWORANGE;'>"; 
   }
  	echo "<td> ". $x . "</td>"; 
  	echo "<td> ". $row["completename"] . "</td>"; 
	echo "<td> ". $row["username"] . "</td>"; 
		echo "<td> ". $row["password"] . "</td>"; 
		echo "<td> ". $row["accesstype"] . "</td>"; 
			echo "<td> ". $row["viewtype"] . "</td>"; 
			  echo "<td> ". lastlogin($row["username"])  . "</td>"; 
    	$myusername = "'". $row["username"] . "'"; 
	echo '<td> <input type="button" id="driver" value="Deactivate" class="class="btn btn-primary" onClick="deleteme('. $myusername. ');"/>' . '</td>';
	echo "</tr>"; 
	}
	
  }
	
      ?> 






    </table>


    </div>

</div>

</div>
