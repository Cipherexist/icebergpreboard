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
    <title>Preboard Accounts</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	  	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="js/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery-1.10.2.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    
    
    $.post("icebergdeletepreboard.php",
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

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1>Android Accounts</h1>
            <div class="form-group">
        </div>
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
<div id="result" class="row" style="margin-top:20px">
    <div class="col-md-offset-2 col-md-8">
</h1>
	<table class="table"> 
    <tr>
    <th> No </th>
    <th> Registered User </th>
       <th> Activation Code </th>
	   <th> Viewtype </th>
        <th> Valid </th>
          <th> Date Created </th>
			 <th> App registered </th>
			   <th> LastLogin </th>
			    <th> Access </th>
			      <th> Purchase </th>
			 	 <th> FUNCTION </th>
    </tr>

      <?php 
$con2 = mysqli_connect('localhost','invictus_user','N@vigator00000','invictus_review');
$fetchqry  = "SELECT * FROM `invictus_review`.`examapproved` Where hide Like 'yes' and controlstatus Like '100' and access Like 'yes'"; 
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
   if($row["status"]=='yes')
   {
	   echo "<tr style='background-color:LIGHTGREEN;'>"; 
   }else
   {
	   echo "<tr style='background-color:YELLOWORANGE;'>"; 
   }
  	echo "<td> ". $x . "</td>"; 
	echo "<td> ". $row["usernameusage"] . "</td>"; 
	echo "<td> ". $row["password"] . "</td>"; 
	echo "<td> ". $row["viewtype"] . "</td>"; 
    echo "<td> ". $row["status"] . "</td>"; 
		echo "<td> ". $row["datecreated"] . "</td>"; 
	echo "<td> ". $row["dateactivated"] . "</td>";
		echo "<td> ". lastlogin($row["usernameusage"])  . "</td>"; 
	$myusername = "'". $row["usernameusage"] . "'"; 
		echo "<td> ". $row["controlstatus"] . "</td>";
			echo "<td> ". $row["purchase"] . "</td>";
	echo '<td> <input type="button" id="driver" value="Deactivate" class="class="btn btn-primary" onClick="deleteme('. $myusername. ');"/>' . '</td>';
	echo "</tr>"; 
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