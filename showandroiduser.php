<?php 
  include 'dbconfig.php';

  function loadtotalquestions($viewtype, $competence)
  {
    include 'dbconfig.php'; 
    $query = "Select * from preboard Where viewtype Like '". $viewtype. "' and competence Like '". $competence . "'";
      $datame = mysqli_query($con, $query);
      if(mysqli_num_rows($datame)!=0)
      {
       
        $codecomplete = mysqli_num_rows($datame); 
      }
      
        return $codecomplete;
  }
  
  function lastlogin($usernameme)
  {
    include 'dbconfig.php'; 
    $query = "Select * from `examuseraccess` Where username Like '". $usernameme. "'";
      $datame = mysqli_query($con, $query);
      if(mysqli_num_rows($datame)!=0)
      {
       while ($row3 = mysqli_fetch_assoc($datame))
        {
          
        $codecomplete = $row3['lastlogin']; 
       }
      }
      else 
      {
        $codecomplete = "";
      }
      
        return $codecomplete;
  }
  
  function loadusersession($username, $viewtype)
  {
    include 'dbconfig.php'; 
    $query = "Select * from user_data Where username Like '". $username. "' and viewtype Like '". $viewtype . "'";
      $datame = mysqli_query($con, $query);
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
    include 'dbconfig.php'; 
    $query = "Select * from `results` Where viewtype Like '".$viewtype . "' and session Like '". $session . "' and competence Like '".$competence. "' and username Like '". $_COOKIE['username'] . "' ORDER BY qno ASC";
      $datame = mysqli_query($con, $query);
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



  $fetchqry  = "SELECT * FROM `examapproved` ORDER BY ID DESC LIMIT 500"; 
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


   @$completename = '"'. $row['usernameusage'] . '"'; 
   @$myid = '"'. $row['ID'] . '"'; 
   if($row["controlstatus"]=='100')
   {
	   echo "<tr style='background-color:#C2FFF9;'>"; 
   }else
   {
	   echo "<tr style='background-color:YELLOWORANGE;'>"; 
   }
  	echo "<td scope='col-md-1'> ". $x . "</td>"; 
	echo "<td scope='col-md-1'> ". $row["usernameusage"] . "</td>"; 
	echo "<td scope='col-md-1'> ". $row["password"] . "</td>"; 
	echo "<td scope='col-md-1'> ". $row["viewtype"] . "</td>"; 
  echo "<td scope='col-md-1'> ". $row["email"] . "</td>"; 
	echo "<td scope='col-md-1'> ". $row["dateactivated"] . "</td>";
		echo "<td scope='col-md-1'> ". lastlogin($row["usernameusage"])  . "</td>"; 
	$myusername = "'". $row["usernameusage"] . "'"; 
		echo "<td scope='col-md-1'> ". $row["controlstatus"] . "</td>";
   
    echo "<td scope='col-md-1'>"; 

    if($row["controlstatus"]=="100")
    {
      echo ' <input type="button" id="driver" value="Deactivate" class="btn btn-danger" onClick="deleteme('. $myusername. ');"/>';
  
    }
    else 
    {
      echo "
      <button type='button' class='btn btn-success' data-toggle='modal' data-target='#modalapprove' onClick='loadmodalid($myid,$completename)';>Activate
      </button>";  
    }
    
  
   
  
  echo "</td>";


  echo "</tr>"; 
	}
	
  }
	
      ?> 

    


