<?php 

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

/*

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
*/




function checkstatus($viewtype, $competence, $percenttotal , $session)
{
  include 'dbconfig.php';
  
     $query = "Select * from `onlineresults` Where course Like '".$viewtype . "' and session Like '". $session . "' and competence Like '".$competence. "' and username Like '". $_COOKIE['username'] . "' AND (status Like 'FAILED' OR status Like 'PASSED') ORDER BY qno ASC";
    $datame = mysqli_query($con, $query);
    $corrected = 0;
    $totalme = 0;
    $codecomplete =0;
    if(!mysqli_error($con))
    {   
        if(mysqli_num_rows($datame)!=0)
        {
          
          $totalme = mysqli_num_rows($datame); 
         
           $corrected =  $totalme;
          
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
  
     $query = "Select * from `onlineaverage` Where viewtype Like '".$viewtype . "' and session Like '". $session . "' and competence Like '".$competence. "' and email Like '". $_COOKIE['username'] . "'";
    $datame = mysqli_query($con, $query);
    $corrected = 0;
    $totalme = 0;
    $codecomplete =0;
    if(!mysqli_error($con))
    {   
        if(mysqli_num_rows($datame)!=0)
        {
          
          while($row3 = mysqli_fetch_array($datame, MYSQLI_ASSOC))
           {
          
            $corrected = $row3['totalcorrect'];
            break;
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
















function loadmaintablesonly()
{
    require 'dbconfig.php';
    require 'forcookie.php';
    //require 'loadmodules.php'; 
    require 'modules.php'; 
    include 'loadfunction2.php';
    
    
    @$myusername = $_COOKIE['usname'];
    @$globelviewtype = $_COOKIE['viewtype'];   
    @$sessionme =  loadmysession($myusername); 
    
    
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
                                    echo "<td>  <a href='quizmode.php?competence=". $row["COMPETENCE"] ."&qn=".  $totalitems ."' style='text-decoration:none'>Continue at ". $newval . "?</td>";
                                 
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
                     
                     //     echo 'Your session is ended, restart to proceed next session';
                  

                  }
                  else 
                  {
                echo 'Your session #'. $sessionme . ' is ongoing';
                  }
    
    
    
    
    
    
                  @$overallpercentage = ($overallpassed/$overallitems) * 100; 
                  @$roundtotal = round($overallpercentage); 
                  @$statusresult = ""; 
                  @$mycolor = ""; 
              
               
              
                  if($proceedend!=$numrows)
                  {
                    $statusresult = "On-going";
                    $mycolor = "background-color:yellow"; 

                    echo "<tr style='$mycolor;'>"; 
                    // echo "<td colspan='7'><strong>$overallpassed/$overallitems*100 = $roundtotal</strong></td>";
                     echo "<td colspan='7'><strong> Average: $overallpercentage% - $statusresult</strong></td>";
                     echo "</tr>"; 
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

                      echo "<tr style='$mycolor;'>"; 
                      @$resetusername = '"'. $_COOKIE['usname'] . '"'; 
                      @$resetclassno = '"'. $_COOKIE['viewtype'] . '"';
              
                   
                      // echo "<td colspan='7'><strong>$overallpassed/$overallitems*100 = $roundtotal</strong></td>";
                       echo "<td colspan='7'><strong> Averages: $overallpercentage% - $statusresult</strong>  <button type='submit' class='btn btn-primary btn-sm' value='submit' name='submit' onclick='endsession($resetusername,$resetclassno)'>Try Again?</button></td>";
                       echo "</tr>"; 
       
                      echo ""; 

                  }
              
              
               
              }
              else 
              {
                  // echo "<td colspan='7'><strong>Empty records: $fetchqry</strong></td>";
              }
    
    
            }
            else 
            {
                echo mysqli_error($con);
            }
}


echo loadmaintablesonly(); 

?> 