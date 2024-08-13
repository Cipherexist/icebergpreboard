<?php 



function deletelastsession($course,$trainee,$session)

{

    include 'dbconfig.php'; 

    $mysqldel = "DELETE from onlineresults Where username Like '$trainee' and course Like '$course' and session Like '$session'"; 

    $dbt = mysqli_query($con,$mysqldel); 

    if(mysqli_error($con))

    {

    echo mysqli_error($con);

    }

} 





function loadmyquestion($qnumber,$mycode,$mysession,$competence)

{

    include 'dbconfig.php'; 



    @$traineeid = $_COOKIE['usname']; 

    

    @$myclasscode = $mycode; 

    @$mynewnumber; 

 

       // $mynewnumber = $qnumber + 1; 

        $mynewnumber = $qnumber; 



 

    @$newsession = $mysession; 

    @$mycompetence = $competence; 



$mysqli = "Select * from onlineresults Where course Like '$myclasscode' and competence Like '$mycompetence' and qno Like '$mynewnumber' and username Like '$traineeid' and session Like '$newsession'"; 

@$thesqlme =  "'" . $mysqli . "'"; 



$dba = mysqli_query($con,$mysqli); 



    if(!mysqli_error($con))

    {

        if(mysqli_num_rows($dba)!=0)

        {

            if($rows = mysqli_fetch_assoc($dba))

            {   

                @$question = str_replace("'","",$rows['question']); 

              

                @$c1 = str_replace("'","",$rows['c1']); 

                @$c2 = str_replace("'","",$rows['c2']); 

                @$c3 = str_replace("'","",$rows['c3']); 

                @$c4 = str_replace("'","",$rows['c4']); 

                @$c1checked = ""; 

                @$c2checked = ""; 

                @$c3checked = ""; 

                @$c4checked = ""; 

                @$uranswernow = $rows['uranswer']; 

                if($rows['c1'] == $rows['uranswer'])

                {

                    $c1checked = "checked";

                }

                else if ($rows['c2'] == $rows['uranswer'])

                {

                    $c2checked = "checked";

                }

                else if ($rows['c3'] == $rows['uranswer'])

                {

                    $c3checked = "checked";

                }

                else if ($rows['c4']== $rows['uranswer'])

                {

                    $c4checked = "checked";

                }

                else 

                {

                    //echo "WALA " . $rows['uranswer'];

                }

                

            

                

                echo "



                <div class='row justify-content-md-center questionstyle'> 

                <h4 class='noselectlarge'>$question</p>

                </div> 



                <div class='row justify-content-md-left choicesstyle' style='margin-top: 10px;'>

                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault1' $c1checked value='$c1'>

                <label class='form-check-label noselect' for='flexRadioDefault1'>

                $c1

                </label>

                </div>



                <div class='row justify-content-md-left choicesstyle'>

                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault2' $c2checked value='$c2'>

                <label class='form-check-label noselect' for='flexRadioDefault2'>

                 $c2

                </label>

                </div>



                <div class='row justify-content-md-left choicesstyle'>

                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault3' $c3checked value='$c3'>

                <label class='form-check-label noselect' for='flexRadioDefault3'>

                $c3

                </label>

                </div>



                <div class='row justify-content-md-left choicesstyle'>

                <input class='form-check-input' type='radio' name='radiochoices' id='flexRadioDefault4' $c4checked value='$c4'>

                <label class='form-check-label noselect' for='flexRadioDefault4'>

                  $c4

                </label>

                </div>

                "; 

                



             }

         }

         else 

         {

            $myaverage = loadmyaverage($traineeid,$myclasscode,$newsession,$mycompetence); 

          //  loadupdatemyaverage($traineeid,$myclasscode,$myaverage); 

            checkmylastsession($traineeid,$myclasscode,$mycompetence,$newsession);

           // inserttohistory($traineeid, $myclasscode);

            echo "<h3> Your Average is : " . $myaverage . "% </h3>";

            if($myaverage<70)

            {

                echo "<h4 style='color: red;'> You need atleast 70% to PASSED the Examination </h4>";

               

            }

            else 

            {

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

   include 'dbconfig.php'; 

   $dbt = mysqli_query($con,$myquery); 

   if(mysqli_error($con))

   {

       echo mysqli_error($con); 

   }



}













function checkmylastsession($traineecode, $code, $competence, $session)

{

    include 'dbconfig.php'; 

    

    $mysqlme = "SELECT * FROM onlineresults Where username Like '$traineecode' and course Like '$code' and competence Like '$competence' and session Like '$session' "; 

    $dbt=mysqli_query($con,$mysqlme); 

    $x = 0; 

    $totalcorrect = 0; 

    $totalcount = 0;



    if(!mysqli_error($con))

    {

        if(mysqli_num_rows($dbt)!=0)

        {

            echo '<table class="table table-bordered mydatatable">';

            echo "<tr>

            <th> NO </th>

            <th> QUESTION </th>

            <th> YOUR ANSWER </th>

            <th> STATUS / CORRECT ANSWER </th>

            </tr>

            ";

            

            while($rows = mysqli_fetch_assoc($dbt))

            {

                @$question = $rows["question"]; 

                @$correctanswer = $rows["answer"]; 

                @$uranswer = $rows["uranswer"]; 

                @$status = $rows["status"]; 

                @$stats = "";

                $totalcount +=1;

                @$x +=1; 



                if($rows['status']=='PASSED')

                {

                    $totalcorrect +=1;

                    echo "<tr style='background-color:lightgreen;'>"; 

                    $stats = "CORRECT";

                }

                else 

                {

                    echo "<tr style='background-color:orange;'>";

                    $stats = "<strong>". $correctanswer . "</strong>";

                }

                echo "<td> $x </td>"; 

                echo "<td> $question </td>"; 

                echo "<td> $uranswer </td>"; 

                echo "<td> $stats </td>"; 

            }



            echo "</table>"; 

      



            $sql2 = "SELECT * from onlineaverage Where email Like '$traineecode' and viewtype Like '$code' and competence Like '$competence' and session Like '$session' "; 

            $dba = mysqli_query($con,$sql2); 



            if(!mysqli_error($con))

            {

                if(mysqli_num_rows($dba)!=0)

                {

                    mysqli_query($con,"DELETE from onlineaverage Where email Like '$traineecode' and viewtype Like '$code' and competence Like '$competence' and session Like '$session' ");

                    

                    if(mysqli_error($con))

                    {

                        echo mysqli_error($con); 

                    }

                }



                @$average = round(($totalcorrect/$totalcount)*100); 

                @$thestatus = ""; 



                if($average>=70)

                {

                    $thestatus = "PASSED";

                }

                else 

                {

                    $thestatus = "FAILED"; 

                }



                @$globaldate = loadregistrationdatetoday(); 

                @$globaltime = loadregistrationtime();



                $insertnow = "INSERT INTO `onlineaverage` (`email`,`viewtype`,`competence`,`session`,`totalcorrect`,`totalitems`,`average`,`status`,`datetoday`,`timetoday`) VALUES ". 

                "('$traineecode','$code','$competence','$session','$totalcorrect','$totalcount','$average','$thestatus','$globaldate','$globaltime')"; 

                mysqli_query($con,$insertnow); 

            

                if(mysqli_error($con))

                {

                    echo mysqli_error($con); 

                }

            }

            else 

            {

                echo mysqli_error($con); 

            }

        

        }

        else 

        {

            echo "NO TABLE TO SHOW";

        } // END





    }

    else 

    {

        echo mysqli_error($con);

    }

}





function inserttohistory($traineecode, $code)

{

    include 'dbconfig.php'; 

    @$sessiondate = date("m-d-y,H:m:s"); 



   

    $mysqlme = "SELECT * FROM onlineresults Where username Like '$traineecode' and course Like '$code'"; 

    $dbt=mysqli_query($con,$mysqlme); 

    $x = 0; 

    if(!mysqli_error($con))

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

              

                $dbax  = mysqli_query($con,$insertsql); 



                if(!mysqli_error($con))

                {

                    echo mysqli_error($con); 

                }

            }



        }

    }

}





function loadmytotalquestions($mycode,$mysession)

{

    include 'dbconfig.php'; 



    @$traineeid = $_COOKIE['usname']; 



    @$myclasscode = $mycode;

    @$newsession = $mysession; 



$mysqli = "Select * from onlineresults Where course Like '$myclasscode' and username Like '$traineeid' and session Like '$newsession'"; 

$dba = mysqli_query($con,$mysqli); 



    if(!mysqli_error($con))

    {

        if(mysqli_num_rows($dba)!=0)

        {

            echo mysqli_num_rows($dba); 

        }

    }



}



function loadmyaverage($traineecode,$code,$sessionme,$mycompetence)

{

    $myaverage = 0; 

    @$mytraineecode = $traineecode; 

    @$mycode = $code; 

    @$mysession = $sessionme; 



    include 'dbconfig.php'; 



    $mysqlme = "SELECT * FROM onlineresults Where username Like '$mytraineecode' and session Like '$mysession' and competence Like '$mycompetence' and course Like '$mycode'"; 

    $dbt=mysqli_query($con,$mysqlme); 



    if(!mysqli_error($con))

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

        echo mysqli_error($con); 

    }



    return round($myaverage);

}





function savetoenrollment($tc,$cn)

{

    include 'dbconfig.php'; 

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



            $dbt = mysqli_query($con,$sqlquery); 



             if(!mysqli_error($con))

             {



             }

             else 

             {

                mysqli_error($con);

             }

    }



}





function loadquizfirsttime($viewtype,$competence,$qn,$sessionnumber) 

{

include 'dbconfig.php';

@$myviewtype = $viewtype; 

@$mycompetence = $competence;

@$email = $_COOKIE['usname'];

@$sessionid = $sessionnumber; 

@$thenumber = $qn; 



    $mysql = "Select * from `preboard` Where `questiontype` Like 'Supplementary' and `viewtype` like '$myviewtype' and `competence` LIKE $mycompetence ORDER BY RAND() LIMIT $thenumber"; 

    $dba = mysqli_query($con, $mysql); 



    if(!mysqli_error($con))

    {

        if(mysqli_num_rows($dba)!=0)

        {   

            @$myemail = $_COOKIE['usname']; 

            @$qno = 0; 



            while($rows = mysqli_fetch_assoc($dba))

            {

            

                @$question = str_replace("'","",$rows['QUESTION']); 

                @$answer = str_replace("'","",$rows['C1']); 

                @$qno +=1; 

                @$my_array = array($rows['C1'],$rows['C2'],$rows['C3'],$rows['C4']);

                

                shuffle($my_array);

                @$c1 =  str_replace("'","",$my_array[0]); 

                @$c2 =  str_replace("'","",$my_array[1]);

                @$c3 =  str_replace("'","",$my_array[2]);

                @$c4 =  str_replace("'","",$my_array[3]);



                $mysqlme = "INSERT INTO `onlineresults` (`qno`,`course`,`question`,`username`,`session`,`answer`,`c1`,`c2`,`c3`,`c4`,`competence`) VALUES('$qno','$myviewtype','$question','$myemail','$sessionid','$answer','$c1','$c2','$c3','$c4','$mycompetence')"; 

                $dbax = mysqli_query($con, $mysqlme); 

                

                if(!mysqli_error($con))

                {

                // echo $numberofdata; 

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

        echo mysqli_error($con); 

    

    }

}







?> 



