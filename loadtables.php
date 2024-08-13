<?php
include 'dbcon.php'; 


function loadvideoslist($classno) 
{
include 'dbcon.php'; 
include 'modules.php'; 

@$coursecode = $classno; 
@$traineeid = $_COOKIE['usname']; 









}
 






function loadtrainingtables($classno) 
{
@$classnumber = $classno; 
@$traineeid = $_COOKIE['usname']; 
include 'dbcon.php'; 

$sqlquery = "Select * from onlineattendance Where classno Like '$classnumber' and traineeid Like '$traineeid'"; 
$dbt = mysqli_query($sqlcon, $sqlquery); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            @$x =  0; 
            while($rows = mysqli_fetch_assoc($dbt))
            {
            $x +=1; 
            @$formonth = $rows['formonth']; 

            @$loadmonth = loadregistrationtocompletedate($rows['formonth']); 
            @$loadtimestart = loadtextreturn("availdates","timestart","Where formonth Like '$formonth' and classno Like '$classnumber'"); 
            @$loadtimeend = loadtextreturn("availdates","timeend","Where formonth Like '$formonth' and classno Like '$classnumber'"); 
            @$completedate = $loadmonth . " ( " . $loadtimestart . "-" . $loadtimeend . ")"; 

            $getinscode = loadtextreturn("availdates","instructor","Where classno Like '$classnumber'"); 
            @$myinstructor = loadinstructorcompletename($getinscode); 
            @$status = $rows['attended']; 
            @$link = loadtextreturn("availdates","zoomlink","Where classno Like '$classnumber' and formonth Like '$formonth'"); 
            @$mycode = loadcompletecoursecode($classnumber); 
            @$ppt = loadtextreturn("codes","ppt","Where codes Like '$mycode'"); 
            @$supptitle = loadtextreturn("codes","supportitle","Where codes Like '$mycode'"); 
            @$supplink = loadtextreturn("codes","supportlink","Where codes Like '$mycode'"); 
            @$zoomlink = '"'. loadtextreturn("availdates","zoomlink","Where classno Like '$classnumber' and formonth Like '$formonth'") . '"'; 
            @$zoomid = '"'. loadtextreturn("availdates","ID ","Where classno Like '$classnumber' and formonth Like '$formonth'") . '"'; 
            @$zoomplatform = '"'. loadtextreturn("availdates","platform","Where classno Like '$classnumber' and formonth Like '$formonth'") . '"'; 
            @$zoomplatformid = '"'.  loadtextreturn("availdates","platformid","Where classno Like '$classnumber' and formonth Like '$formonth'") . '"'; 
            @$zoomplatformcode = '"'. loadtextreturn("availdates","passcode","Where classno Like '$classnumber' and formonth Like '$formonth'") . '"'; 
            @$videosavail = loadtextreturn("codesvideo","videoname","Where code Like '$mycode'"); 
          
          
            @$typeofclass = ""; 


            if($link!="")
            {
              $typeofclass = "Online";
            }
            elseif($ppt!="")
            {
              $typeofclass = "Computer Based";
            }
            else 
            {
              $typeofclass ="On-Site";
              $status = "On-site";
            }
            echo "
                <tr>
                <td scope='row'>$x</td>
                <td scope='row'>$completedate</td>
                <td scope='row'>$typeofclass</td>
                <td scope='row'>$myinstructor</td>
                <td scope='row'>$status</td>
                <td>"; 
                @$loadmycode = loadcompletecoursecode($classnumber);
                if($link!="")
                {

                  $trainingdate = loadcoursefirstdate($classnumber); 
                  $todaydate = loadregistrationdatetoday(); 
                    if ($trainingdate <= $todaydate)
                    {
                      echo "<button type='button' class='btn btn-success' data-toggle='modal' data-target='#addzoom' onclick='loadmodalzoomschedule($zoomid,$zoomlink,$zoomplatform,$zoomplatformid,$zoomplatformcode)'>
                      Virtual
                      </button>";
                    }
                    else 
                    {
                      echo "<button type='button' class='btn btn-secondary' onclick='zoomnotavailable()'>
                      Virtual
                      </button>";
                    }



                }
                if($videosavail!="")
                {
                  echo "<a href='videos.php?code=$mycode' target='_blank'> <button type='button' class='btn btn-primary' btn-lg btn-block>Videos</button></a>";
                }

                if($ppt!="")
                {
                  echo "<a href='trainings/PPT.php?classno=$classnumber'> <button type='button' class='btn btn-primary' btn-lg btn-block>Presentation</button></a>";
                }
                if($supptitle!="")
                {
                    $trainingdate = loadcoursefirstdate($classnumber); 
                    $todaydate = loadregistrationdatetoday(); 
                    if ($trainingdate <= $todaydate)
                    {
                      echo "<a href='$supplink'> <button type='button' class='btn btn-warning' btn-lg btn-block>$supptitle</button></a>";
            
                    }
                    else 
                    {
                      echo "<button type='button' class='btn btn-secondary' btn-lg btn-block onclick='pretestnotavailable()'>$supptitle</button>";
            
                    }
                
                }
          
                 echo "</td></tr>";
            } 
        }
        else 
        {
            echo 'No record on database:' . $traineeid;
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }
}



function loadregistrarschedule($classno) 
{
@$classnumber = $classno; 
@$traineeid = $_COOKIE['usname']; 
include 'dbcon.php'; 

$sqlquery = "Select * from availdates Where classno Like '$classnumber' ORDER BY formonth ASC"; 
$dbt = mysqli_query($sqlcon, $sqlquery); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            @$x =  0; 
            while($rows = mysqli_fetch_assoc($dbt))
            {
            $x +=1; 
            @$loadmonth = loadregistrationtocompletedate( $rows['formonth']); 
            $getinscode = loadtextreturn("availdates","instructor","Where classno Like '$classnumber'"); 
            @$myinstructor = loadinstructorcompletename($getinscode); 

            echo "
                <tr>
                <td scope='row'>$x</td>
                <td scope='row'>$loadmonth</td>
                <td scope='row'>CBT</td>
                <td scope='row'>$myinstructor</td>
                <td scope='row'>
                Echo
                </td>

                </tr>

            ";
            } 
        }
        else 
        {
            echo 'No record on database:' . $traineeid;
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }
}





function loadcashierlist() 
{
    include 'dbcon.php'; 
    @$sqlquery = "Select * from onlinetrainings Where status Like 'Waiting for Approval' or status like 'for payment' ORDER BY dateinput ASC"; 
    $dbt = mysqli_query($sqlcon,$sqlquery); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {

            while($rows = mysqli_fetch_assoc($dbt))
            {
              
                @$mycompletename = loadtraineecompletename($rows['traineeid']); 
                @$code = $rows['code'];
                @$completetrainingdate  = loadcompletetrainingdate($rows['classcode']); 
                @$status = $rows['status']; 
                @$picturelocation = '"'. $rows['paymentlocation'] .'"';
                @$traineecode = '"'. $rows['traineeid'] .'"';
                @$classnumberforjava = '"'. $rows['classcode'] .'"';
                @$picturelocation = '"'. $rows['paymentlocation'] .'"';
                @$foryes = '"approve"';
                @$forno = '"disapprove"';
                echo "
                <tr>
                <td scope='row'>$mycompletename</td>
                <td scope='row'>$code</td>
                <td scope='row'>$completetrainingdate</td>
                <td scope='row'>$status</td>
                <td>"; 

                echo "
                <button type='button' class='btn btn-primary btndefault' btn-lg btn-block onclick='paymentconfirm($classnumberforjava,$traineecode)'>
                <p class='btntext'>Approval</p>
                </button>"; 

                if($rows['status']=='Waiting for Approval')
                {
                echo "
                <button type='button' class='btn btn-warning btndefault' btn-lg btn-block data-toggle='modal' data-target='#modalpicture' onclick='loadmodalimageupload($picturelocation,$traineecode)'>
                <p class='btntext'>Show Payment</p>
                </button>"; 
                }
                echo "</td></tr>";
            }
        }
    }
    else
    {
        echo mysqli_error($sqlcon); 
    }



}

function loadmyinformationmodal()
{


    @$username = $_COOKIE['usname']; 

    include 'dbcon.php'; 

    $sqlquery = "Select * from onlinetrainee Where username Like '$username'";
    
    $dbt = mysqli_query($sqlcon,$sqlquery); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$completename = $rows['completename']; 
                @$mobilenumber = $rows['mobilenumber']; 
                @$birthdate = $rows['birthdate']; 
                @$rank =  $rows['currentrank']; 
                @$homeaddress =  $rows['homeaddress']; 
                @$firstname = $rows['firstname'];
                @$middlename = $rows['middlename'];
                @$lastname = $rows['lastname'];


                echo 
                "
                <div class='modal fade' id='editmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' style='overflow-y: scroll;'>
                <div class='modal-dialog modal-lg' role='document'>
                  <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='editmodal'><p id='paymentclassno'>Edit Information</p></h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                          <form>

                              <div class='row'>
                                  <div class='col-sm-12'>
                                  <label for='completename'>Certificate Name ( Ex. Ryan C. Dela Cruz )</label>
                                  <input type='text' class='form-control' id='completename' name='completename' placeholder='Ex. Ryan C. Dela Cruz' value='$completename'>
                                  </div>
                              </div>
                          
                              <div class='row'>
                                
                                  <div class='col-sm-4'>
                                  <label for='firstname'>Firstname</label>
                                  <input type='text' class='form-control' id='firstname' name='firstname' placeholder='Enter your firstname' value='$firstname'>                         
                                  </div>

                                  <div class='col-sm-4'>
                                  <label for='middlename'>Middlename</label>
                                  <input type='text' class='form-control' id='middlename' name='middlename' placeholder='Enter your middlename' value='$middlename'>                         
                                  </div>

                                  <div class='col-sm-4'>
                                  <label for='lastname'>Lastname</label>
                                  <input type='text' class='form-control' id='lastname' name='lastname' placeholder='Enter your lastname' value='$lastname'>                         
                                  </div>

                              </div>

                              

     
                              <div class='row'>
                                  <div class='col-sm-4'>
                                  <label for='mobilenumber'>Mobile Number</label>
                                  <input type='number' class='form-control' id='mobilenumber' name='mobilenumber' placeholder='09*********' value='$mobilenumber'>
                                  </div>"; 

                                  echo "
                                  <div class='col-sm-4'>
                                  <label for='currentrank'>Select Your Current Rank</label>
                                  <select class='form-control' id='currentrank' name='currentrank' >
                                  ";
                    
                                    $query = "Select * from rank Where active Like 'yes' ORDER BY ranked ASC"; 
                                    $datame1 = mysqli_query($sqlcon ,$query);
                                    if(mysqli_num_rows($datame1)!=0)
                                    {
                                          while($row = mysqli_fetch_assoc($datame1))
                                        {
                                            @$ranked =  $row["ranked"]; 
                                            if($rank==$ranked)
                                            {
                                            echo "<option class='form-control' value='$ranked' selected>$ranked</option>";
                                            }
                                            else 
                                            {
                                              echo "<option class='form-control' value='$ranked'>$ranked</option>";   
                                            }    
                                        }
                                    }            
                                    
                                    echo  "</select> 
                                    </div> 

                                    <div class='col-sm-4'>
                                    <label for='birthdate'>Birthdate (MM/DD/YYYY)</label>
                                    <input type='text' class='form-control' id='birthdate' name='birthdate' placeholder='' value='$birthdate'>
                                    </div>

                                    </div>"; 


                              echo " 
                              <div class='row'>
                                  <div class='col-sm-12'>
                                  <label for='homeaddress'>Home Address</label>
                                  <input type='text' class='form-control' id='homeaddress' name='homeaddress' placeholder='Enter Your Address' value='$homeaddress'>
                                  </div>
                              </div>
                     
                            <div class='form-group' id='uploaderror' >
                          
                            </div>
            
                          </form>
                      </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                      <button id='upload-button' class='btn btn-primary btn-large' onclick='saveinfo()'> Save </button>
                    </div>
                  </div>
                </div>
              </div>
                ";


            }
        }
        else{ echo $sqlquery; }
    }
    else 
    {
        echo mysqli_error($sqlcon); 

    }
    



} 








function loadmyinformation()
{


    @$username = $_COOKIE['usname']; 

    include 'dbcon.php'; 

    $sqlquery = "Select * from onlinetrainee Where username Like '$username'";
    
    $dbt = mysqli_query($sqlcon,$sqlquery); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$completename = $rows['completename']; 
                @$mobilenumber = $rows['mobilenumber']; 
                @$birthdate = $rows['birthdate']; 
                @$rank =  $rows['currentrank']; 
                @$homeaddress =  $rows['homeaddress']; 
                @$profilepic =  $rows['pictureloc']; 
               
                if($profilepic!="")
                {
                echo "<img src='$profilepic' alt='...' class='rounded float-left' style='width: 200px; height: 200px;'>"; 
                }
                else 
                {
                  echo "<img src='profilepic/nopic.jpg' alt='...' class='rounded float-left' style='width: 200px; height: 200px;'>"; 
                }
                echo "
                <div class='row perform col-md-16'>
                <div class='col-md-2 borderstitle'> 
                  <p>Certificate Name</p>
                </div>
            
                <div class='col-md-4 borderstext'> 
                  <p>$completename</p>
                </div>
            
                <div class='col-md-2 borderstitle'> 
                  <p>Birthdate</p>
                </div>
            
                <div class='col-md-4 borderstext'> 
                  <p>$birthdate</p>
                </div>
                </div>
            
                <div class='row perform col-md-16'>
                <div class='col-md-2 borderstitle'> 
                  <p>Contact Number</p>
                </div>
            
                <div class='col-md-4 borderstext'> 
                  <p>$mobilenumber</p>
                </div>
            
                <div class='col-md-2 borderstitle'> 
                  <p>Rank</p>
                </div>
            
                <div class='col-md-4 borderstext'> 
                  <p>$rank</p>
                </div>
                 </div>
            
            
                <div class='row perform col-md-16'>
                <div class='col-md-2 borderstitle'> 
                  <p>Address</p>
                </div>
            
                <div class='col-md-10 borderstext'> 
                  <p>$homeaddress</p>
                </div>
            
            
                </div>
                ";


                echo 
                "
                <div class='modal fade' id='editmodal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                <div class='modal-dialog' role='document'>
                  <div class='modal-content'>
                      <div class='modal-header'>
                        <h5 class='modal-title' id='editmodal'><p id='paymentclassno'>Edit Information</p></h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>
                      <div class='modal-body'>
                          <form>

                              <div class='form-group'>
                                  <label for='completename'>Certificate Name</label>
                                  <input type='text' class='form-control' id='completename' name='completename' placeholder='Enter Certificate Name' value='$completename'>
                              </div>
                          
     
                              <div class='form-group'>
                                  <label for='mobilenumber'>Mobile Number</label>
                                  <input type='number' class='form-control' id='mobilenumber' name='mobilenumber' placeholder='09*********' value='$mobilenumber'>
                              </div>
            
                              <div class='form-group'>
                                  <label for='homeaddress'>Home Address</label>
                                  <input type='text' class='form-control' id='homeaddress' name='homeaddress' placeholder='Enter Your Address' value='$homeaddress'>
                              </div>
                     
                            <div class='form-group' id='uploaderror' >
                          
                            </div>
            
                          </form>
                      </div>
                    <div class='modal-footer'>
                      <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                      <button id='upload-button' class='btn btn-primary btn-large' onclick=''> Save </button>
                    </div>
                  </div>
                </div>
              </div>
                ";


            }
        }
        else{ echo $sqlquery; }
    }
    else 
    {
        echo mysqli_error($sqlcon); 

    }
    



} 





?>