<?php 

function deletelastsession($course,$trainee,$session)
{
    include 'dbcon.php'; 
    $mysqldel = "DELETE from onlineresults Where username Like '$trainee' and course Like '$course' and session Like '$session'"; 
    $dbt = mysqli_query($sqlcon,$mysqldel); 
    if(mysqli_error($sqlcon))
    {
    echo mysqli_error($sqlcon);
    }
} 


function loadmyquestion($qnumber,$mycode,$mysession)
{
    include 'dbcon.php'; 

    @$traineeid = $_COOKIE['usname']; 
    @$traineecode = $_COOKIE['traineecode']; 
    
    @$myclasscode = $mycode; 
    @$mynewnumber = $qnumber + 1; 
    @$newsession = $mysession; 
    @$myclassnumber = $classnumber;

$mysqli = "Select * from onlineresults Where course Like '$myclasscode' and qno Like '$mynewnumber' and username Like '$traineeid' and session Like '$newsession'"; 
$dba = mysqli_query($sqlcon,$mysqli); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dba)!=0)
        {
            if($rows = mysqli_fetch_assoc($dba))
            {   
                @$question = $rows['question']; 
                @$c1 = $rows['c1']; 
                @$c2 = $rows['c2']; 
                @$c3 = $rows['c3']; 
                @$c4 = $rows['c4']; 

                echo "

                <div class='row justify-content-md-center questionstyle'> 
                <h4 class='noselect'>$question</p>
                </div> 

                <div class='row justify-content-md-left choicesstyle' style='margin-top: 10px;'>
                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault1' checked value='$c1'>
                <label class='form-check-label' for='flexRadioDefault1'>
                <h5 class='noselect'>$c1</h5>
                </label>
                </div>

                <div class='row justify-content-md-left choicesstyle'>
                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault2' value='$c2'>
                <label class='form-check-label' for='flexRadioDefault2'>
                <h5 class='noselect'>$c2</h5>
                </label>
                </div>

                <div class='row justify-content-md-left choicesstyle'>
                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault2' value='$c3'>
                <label class='form-check-label' for='flexRadioDefault2'>
                <h5 class='noselect'>$c3</h5>
                </label>
                </div>

                <div class='row justify-content-md-left choicesstyle'>
                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault2' value='$c4'>
                <label class='form-check-label' for='flexRadioDefault2'>
                <h5 class='noselect'>$c4</h5>
                </label>
                </div>
                "; 
             }
         }
         else 
         {
            $myaverage = loadmyaverage($traineeid,$myclasscode,$newsession); 
            loadupdatemyaverage($traineeid,$myclasscode,$myaverage); 
            checkmylastsession($traineeid,$myclasscode);
            inserttohistory($traineeid, $myclasscode);
            echo "<h3> Your Average is : " . $myaverage . "% </h3>";
            if($myaverage<75)
            {
                echo "<h4 style='color: red;'> You need atleast 75% to PASSED the Examination </h4>";
               
            }
            else 
            {
                savetoenrollment($traineecode,$myclasscode); 
                sendemail($traineeid,$myclasscode,$myaverage);
                echo "<h4 style='color: green;'> Congratulations you PASSED the Exam! </h4>";
              
           
            }
         }
    }
}


function sendemail($traineecode,$myclasscode,$totalaverage)
{
    require 'PHPMailer/PHPMailerAutoload.php';
    
    $mail = new PHPMailer;
    // Set mailer to use SMTP
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'shu20.unified-servers.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@navigatormaritime.com';                 // SMTP username
    $mail->Password = 'N@vigator0000';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;    
    
    
    $mail->setFrom('info@navigatormaritime.com', 'EXAMINATION PASSED');
    //$mail->addAddress('registrar@navigatormaritime.com');     // Add a recipient
    $mail->addAddress('marketing@navigatormaritime.com');   
    $mail->addAddress('registrar@navigatormaritime.com');   
   // $mail->addAddress('mis@navigatormaritime.com');   
    //$mail->addAddress('info@navigatormaritime.com');   
    //  $mail->addAddress('mmvalerio@navigatormaritime.com');  
    // $mail->addAddress('mis@navigatormaritime.com');  
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    //$mail->isHTML(true);                                  // Set email format to HTML
    $mycode = loadcompletecoursecode($myclasscode);
    $mail->Subject = 'Online Training is finished for <'. loadtraineecompletename($traineecode) . '>' ;
    $mail->Body    =  '<p> Course: '. loadcompletecoursename($mycode) .'</p>'.
    '</br>'.
    '<p>Date Training: '. loadcompletetrainingdate($myclasscode) . '</p>'.
    '<p>Complete Name: '. loadtraineecompletename($traineecode) .'</p>'.
    '<p>Total Score: '. $totalaverage .'%</p>'.
    '</br>'.
    '<p> MESSAGE: You can now passed on the navisys to print the certificate</p>'.
    $mail->AltBody = '(This is automated, do not reply)';
    
    if(!$mail->send()) 
    {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    
    } 
    else 
    {
    // echo 'Data has been saved';
    }


}

function loadupdatemyaverage($traineecode,$classcode,$average) 
{
    @$mytraineeid = $traineecode; 
    @$mycode = $classcode; 
    @$myaverage = $average; 


    if($myaverage>=75)
    {
        $myquery = "UPDATE `onlinetrainings` SET `average`='$myaverage', `status`='Passed' Where traineeid Like '$traineecode' and classcode Like '$mycode'"; 

    }
    else 
    {
        $myquery = "UPDATE `onlinetrainings` SET `average`='$myaverage' Where traineeid Like '$traineecode' and classcode Like '$mycode'"; 
    }
   include 'dbcon.php'; 
   $dbt = mysqli_query($sqlcon,$myquery); 
   if(mysqli_error($sqlcon))
   {
       echo mysqli_error($sqlcon); 
   }

}


function checkmylastsession($traineecode, $code)
{
    include 'dbcon.php'; 

   
    $mysqlme = "SELECT * FROM onlineresults Where username Like '$traineecode' and course Like '$code'"; 
    $dbt=mysqli_query($sqlcon,$mysqlme); 
    $x = 0; 
    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            echo '<table class="table table-bordered mydatatable">';
            echo "<tr>
            <th> NO </th>
            <th> QUESTION </th>
            <th> YOUR ANSWER </th>
            <th> STATUS </th>
            </tr>
            ";
            
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$question = $rows["question"]; 
                @$uranswer = $rows["uranswer"]; 
                @$status = $rows["status"]; 
                @$stats = "";

                @$x +=1; 

                if($rows['status']=='PASSED')
                {
                    echo "<tr style='background-color:lightgreen;'>"; 
                    $stats = "CORRECT";
                }
                else 
                {
                    echo "<tr style='background-color:orange;'>";
                    $stats = "WRONG";
                }
                echo "<td> $x </td>"; 
                echo "<td> $question </td>"; 
                echo "<td> $uranswer </td>"; 
                echo "<td> $stats </td>"; 
            }

            echo "</table>"; 
        }
    }
}


function inserttohistory($traineecode, $code)
{
    include 'dbcon.php'; 
    @$sessiondate = date("m-d-y,H:m:s"); 

   
    $mysqlme = "SELECT * FROM onlineresults Where username Like '$traineecode' and course Like '$code'"; 
    $dbt=mysqli_query($sqlcon,$mysqlme); 
    $x = 0; 
    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
        
            
            while($rows = mysqli_fetch_assoc($dbt))
            {
                @$question = $rows["question"]; 
                @$uranswer = $rows["uranswer"]; 
                @$status = $rows["status"]; 
                @$stats = "";

                $insertsql = "INSERT INTO `onlineresulthistory` (`session`,`question`,`youranswer`,`status`,`username`,`classno`) VALUES ". 
                "('$sessiondate','$question','$uranswer','$status','$traineecode','$code')"; 
              
                $dbax  = mysqli_query($sqlcon,$insertsql); 

                if(!mysqli_error($sqlcon))
                {
                    echo mysqli_error($sqlcon); 
                }
            }

        }
    }
}


function loadmytotalquestions($mycode,$mysession)
{
    include 'dbcon.php'; 

    @$traineeid = $_COOKIE['usname']; 

    @$myclasscode = $mycode;
    @$newsession = $mysession; 

$mysqli = "Select * from onlineresults Where course Like '$myclasscode' and username Like '$traineeid' and session Like '$newsession'"; 
$dba = mysqli_query($sqlcon,$mysqli); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dba)!=0)
        {
            echo mysqli_num_rows($dba); 
        }
    }

}

function loadmyaverage($traineecode,$code,$sessionme)
{
    $myaverage = 0; 
    @$mytraineecode = $traineecode; 
    @$mycode = $code; 
    @$mysession = $sessionme; 

    include 'dbcon.php'; 

    $mysqlme = "SELECT * FROM onlineresults Where username Like '$mytraineecode' and session Like '$mysession' and course Like '$mycode'"; 
    $dbt=mysqli_query($sqlcon,$mysqlme); 

    if(!mysqli_error($sqlcon))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            $mytotalpass = 0; 
            $totalcount = mysqli_num_rows($dbt); 

            while($rows = mysqli_fetch_assoc($dbt))
            {
              if($rows['status']=='PASSED')
              {
                  $mytotalpass +=1; 

              }    
            }
            $myaverage = ($mytotalpass / $totalcount) * 100;
        }
    }
    else 
    {
        echo mysqli_error($sqlcon); 
    }

    return round($myaverage);
}


function savetoenrollment($tc,$cn)
{
    include 'dbcon.php'; 
    @$traineecode = $tc; 
    @$classno = $cn; 
    @$code = loadcompletecoursecode($classno); 
    @$coursefee = loadcoursefee($code); 
    @$regnumber = generateregistrationnumber(); 
    @$regno = loadregistrationdatetoday(); 
    @$timetoday = loadregistrationtime(); 
    $where = "Where traineecode Like '$traineecode' and classno Like '$classno'"; 
    $where2 = "Where traineecode Like '$traineecode' and classcode Like '$classno'"; 
    @$manning = loadtextreturn("onlinetrainings","manning",$where2); 
    @$operator = loadtextreturn("onlinetrainings","operator",$where2); 
    @$principal = loadtextreturn("onlinetrainings","principal",$where2); 



    if(loadnumberofdataall("monitor",$where)==0)
    {
        
            $sqlquery = "INSERT INTO `monitor` (`regno`,`regdate`,`traineecode`,`classno`,`code`,`chargetocom`,`manning`,`operator`,`cument`,`branchcode`,`username`,`cost`,`courseprice`,`status`,`usertime`,`ufsid`) ". 
            " VALUES ('$regnumber','$regno','$traineecode','$classno','$code','Trainee','$manning','$operator','$principal','NAVI-1','ONLINE','$coursefee','$coursefee','no','$timetoday','no')"; 

            $dbt = mysqli_query($sqlcon,$sqlquery); 

             if(!mysqli_error($sqlcon))
             {

             }
             else 
             {
                mysqli_error($sqlcon);
             }
    }

}


function loadquizfirsttime($viewtype,$competence) 
{
include 'dbcon.php';
@$myviewtype = $viewtype; 
@$mycompetence = $competence;


$mysql = "Select * from `preboard` Where `viewtype` like '$myviewtype' and COMPETENCE LIKE '$mycompetence' ORDER BY ID LIMIT 50"; 
$dba = mysqli_query($con, $mysql); 

if(!mysqli_error($con))
{
  if(mysqli_num_rows($dba)!=0)
  {
    @$myemail = $_COOKIE['usname']; 

    @$sessionid = loadmysession($myemail); 

    @$qno = 0; 

    while($rows = mysqli_fetch_assoc($dba))
    {
        
       @$question = $rows['question']; 
       @$answer = $rows['c1']; 
       @$qno +=1; 
       @$my_array = array($rows['c1'],$rows['c2'],$rows['c3'],$rows['c4']);

       shuffle($my_array);
       @$c1 = $my_array[0]; 
       @$c2 = $my_array[1];
       @$c3 = $my_array[2];
       @$c4 = $my_array[3];

       $mysqlme = "INSERT INTO `onlineresults` (`qno`,`course`,`question`,`username`,`session`,`answer`,`c1`,`c2`,`c3`,`c4`) VALUES('$qno','$mycoursecode','$question','$traineeid','$sessionid','$answer','$c1','$c2','$c3','$c4')"; 
       $dbax = mysqli_query($con, $mysqlme); 
       
       if(!mysqli_error($con))
       {

       }
       else 
       {
           echo mysqli_error($con); 
       }

    }
  }
  else
  {
      echo  "LOADFIRSTTIME: " . $mysql; 
  }
}
else
{
    echo mysqli_error($sqlcon); 
    echo $mysql; 
}





}


?> 

