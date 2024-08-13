

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
    echo 'cookie not set!';
}

@$sessionme =  loadmysession($myusername); 

@$overallpassed = 0; 
@$overallitems = 0; 
@$overallpercentage = 0; 
@$numrows=0;
@$proceedend = 0; 
@$globaldate = loadregistrationdatetoday(); 
@$globaltime = loadregistrationtime();



$mysqlme = "INSERT INTO `preboardlogs` (`username`,`dateaccess`,`timeaccess`) VALUES ('$myusername','$globaldate','$globaltime')"; 
mysqli_query($con,$mysqlme); 
if(mysqli_error($con))
{
    echo mysqli_error($con);
}





?>


<?php  
include 'navbardefault.php';


function loadtotalquestions($viewtype, $competence)
{
  include 'dbconfig.php';
  $query = "Select * from `preboard` Where viewtype Like '". $viewtype. "' and competence Like '". $competence . "'";
    $datame = mysqli_query($con, $query);
    if(mysqli_num_rows($datame)!=0)
    {
     
      $codecomplete = mysqli_num_rows($datame); 
    }
    
      return $codecomplete;
}

function loadusersession($username, $viewtype)
{
  include 'dbconfig.php';
  $query = "Select * from `examapproved` Where email Like '". $username. "' and viewtype Like '". $viewtype . "'";
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
  
     $query = "Select * from `onlineresults` Where course Like '".$viewtype . "' and session Like '". $session . "' and competence Like '".$competence. "' and username Like '". $_COOKIE['username'] . "' ORDER BY qno ASC";
    $datame = mysqli_query($con, $query);
    $corrected = 0;
    $totalme = 0;
    $codecomplete =0;
    if(!mysqli_error($con))
    {   
        if(mysqli_num_rows($datame)!=0)
        {
          
          $totalme = mysqli_num_rows($datame); 
          while($row3 = mysqli_fetch_array($datame, MYSQLI_ASSOC))
           {
            if($row3['uranswer']!="")
            {
            $corrected += 1 ;
            }
           }

        }
   }
   else 
   {
    echo mysqli_error($con);
   }
      if($corrected >0)
      {
        $codecomplete = $corrected;
      }

      return $codecomplete;
}


function checkcorrecttotal($viewtype, $competence, $percenttotal , $session)
{
  include 'dbconfig.php';
  
     $query = "Select * from `onlineresults` Where course Like '".$viewtype . "' and session Like '". $session . "' and competence Like '".$competence. "' and username Like '". $_COOKIE['username'] . "' ORDER BY qno ASC";
    $datame = mysqli_query($con, $query);
    $corrected = 0;
    $totalme = 0;
    $codecomplete =0;
    if(!mysqli_error($con))
    {   
        if(mysqli_num_rows($datame)!=0)
        {
          
          $totalme = mysqli_num_rows($datame); 
          while($row3 = mysqli_fetch_array($datame, MYSQLI_ASSOC))
           {
            if($row3['status']=="PASSED")
            {
            $corrected += 1 ;
            }
           }

        }
   }
   else 
   {
    echo mysqli_error($con);
   }
      if($corrected >0)
      {
        $codecomplete = $corrected;
      }

      return $codecomplete;
}



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


</script>



<div class="container">
<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h3>Preboard Section</h3>
            <div class="form-group">
              <h3> <?php echo $globelviewtype; ?> </h3>
  </div>
  
  <?php 
        @$resetusername = '"'. $_COOKIE['usname'] . '"'; 
        @$resetclassno = '"'. $_COOKIE['viewtype'] . '"';

         echo "<button type='submit' class='btn btn-primary btn-large' value='submit' name='submit' onclick='endsession($resetusername,$resetclassno)'>End your session</button>"; 


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
    <tbody>

      <?php 

$fetchqry  = "SELECT * FROM `competence` WHERE VIEWTYPE LIKE '".  $globelviewtype ."'"; 
  $datame1 = mysqli_query($con,$fetchqry);

  $x = 0; 
  

    if(!mysqli_error($con))
    {
          if(mysqli_num_rows($datame1)!=0)
          {
         
                 while($row = mysqli_fetch_assoc($datame1))
                   {
                            if($row["NEWSYSTEM"]=="YES") 
                              {
                         $numrows +=1; 
                    //  setcookie('username', $row["username"], time()+$setlimit);
                   //  setcookie('viewtype', $row["viewtype"], time()+$setlimit);
                      //setcookie('completename', $row["completename"], time()+$setlimit);
                        $x = $x +1; 
                    $loadtotal = loadtotalquestions($row["VIEWTYPE"], $row["COMPETENCE"]);
                    $totalitems = $row["CONTENTS"];
                    $overallitems += $row["CONTENTS"];
                //  $totalitems = 50; 
                   echo "<tr >"; 
                    echo "<td> ". $row["COMPETENCE"] . "</td>";
                      echo "<td> ". $row["STATUS"] . "</td>"; 
                    echo "<td> ". $loadtotal . "</td>"; 
                        echo "<td> ". $totalitems . "</td>"; 
                          echo "<td> ". $row["PERCENTAGE"]. "%" . "</td>"; 
                          
                          $myresult = checkstatus($row["VIEWTYPE"], $row["COMPETENCE"] , $row["PERCENTAGE"] ,   $sessionme);
                          $newval = $myresult + 1;
                          $correctcount = checkcorrecttotal($row["VIEWTYPE"], $row["COMPETENCE"] , $row["PERCENTAGE"] ,   $sessionme); 
                          $overallpassed += $correctcount; 
        
                          if ($myresult >0)
                         {
                               $proceedend +=1; 
        
                              if($myresult>=$totalitems)
                              {
                                $myaverage = loadmyaverage($_COOKIE['username'],$_COOKIE['viewtype'],$sessionme,$row["COMPETENCE"]); 
                                echo "<td>  <a href='quizmode.php?competence=". $row["COMPETENCE"] ."&qn=".  $totalitems ."' style='text-decoration:none'>Result: ". $myaverage . "%</td>";
                           
                              } 
                              else 
                              {
                                echo "<td>  <a href='quizmode.php?competence=". $row["COMPETENCE"] ."&qn=".  $totalitems ."' style='text-decoration:none'>Continue ". $newval . "?</td>";
                             
                              }
                        }
                         else 
                         {
                            echo "<td>  <a href='quizmode.php?competence=".$row["COMPETENCE"] ."&qn=". $totalitems ."' style='text-decoration:none'>Start</a></td>";
                  
                          }
                 //  echo "<td>  <a href='reading.php?competence=".$x."&qn=". $row["CONTENTS"] ."' style='text-decoration:none'>Proceed Reading </a></td>";
                        // echo "<td>  <a href='quizmode.php?competence=".$row["COMPETENCE"] ."&qn=". $loadtotal/2 ."' style='text-decoration:none'>50% EXAM </a></td>";
                        echo "</tr>"; 
                        }
                       else
                        {
                              echo "<tr>"; 
                               echo "<td> ". $row["COMPETENCE"] . "</td>";
                                echo "<td> ". $row["STATUS"] . "</td>"; 
                                echo "<td colspan='5'> shall be evidence by approved training and experience related thereto in accordance with Section A-VI of the STCW Code</td>"; 
                               echo "</tr>"; 
                        }
                  }
              
            
              if($proceedend==$numrows)
              {
                 
                      echo 'Your session is ended, restart to proceed next session';
              }
              else 
              {
            echo 'Your session #'. $sessionme . ' is ongoing';
              }
          }
          else 
          {
               echo "<td colspan='7'><strong>Empty records: $fetchqry</strong></td>";
          }
        }
        else 
        {
            echo mysqli_error($con);
        }
      ?> 

</tbody>

     <?php 
    @$overallpercentage = ($overallpassed/$overallitems) * 100; 
    @$roundtotal = round($overallpercentage); 
    @$statusresult = ""; 
    @$mycolor = ""; 

 

    if($proceedend!=$numrows)
    {
      $statusresult = "On-going";
      $mycolor = "background-color:yellow"; 
    }
    else 
    {

        if($roundtotal>75)
        {
          $statusresult = "Passed";
          $mycolor = "background-color:green"; 
        }
        else 
        {
          $statusresult = "Failed";
          $mycolor = "background-color:orange"; 
        }
    }


      echo "<tr style='$mycolor;'>"; 
     // echo "<td colspan='7'><strong>$overallpassed/$overallitems*100 = $roundtotal</strong></td>";
      echo "<td colspan='7'><strong> Average: $overallpercentage% - $statusresult</strong></td>";
     echo "</tr>"; 



    ?> 


    </table>

</div>

</div>