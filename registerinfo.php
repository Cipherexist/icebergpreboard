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
  
    <div class="col-md-offset-2 col-md-8">
          
        <form action="" method="post">
            
            
                 <div class="form-group">
           <label for="viewtype">Review Course (Select Review)</label>
           <select class="form-control" id="coursename" name="viewtype" style="font-weight: bold; color:#000;">

           <option class="form-control" value="Deck Management level"> Deck Management Level</option>
           <option class="form-control" value="Engine Management level"> Engine Management Level</option>
           <option class="form-control" value="Deck Operational level"> Deck Operational Level</option>
           <option class="form-control" value="Engine Operational level"> Engine Operational Level</option>
          </select> 
       </div>
            
            
            
            <h3 style="background-color: blue; text-align: center; color: white;"> SIGN-UP FORM</h3>
            <div class="form-group">
                <label for="firstname">Firstname</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter your firstname" Required>
            </div>
              <div class="form-group">
                <label for="middlename">Middlename</label>
                <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Enter your middlename" Required>
            </div>
            
            
            <div class="form-group">
                <label for="lastname">Lastname</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your lastname" Required>
            </div>
            
              <div class="form-group">
           <label for="datepick1">Birthdate</label>
          <input type="text" class="form-control" id="datepick1" name="datepick1" placeholder="Enter your birthday" Required>
          </div>
          
          <div class="form-group">
                <label for="birthplace">Birthplace</label>
                <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Enter your Birthplace" Required>
            </div>
            
            
                 <div class="form-group">
           <label for="currentrank">Select Your Current Rank</label>
           <select class="form-control" id="currentrank" name="currentrank" style="font-weight: bold; color:#000;">

            <option class="form-control" value="Master">Master</option>
            <option class="form-control" value="Chiefmate">Chiefmate</option>
            <option class="form-control" value="2/OFF">2/OFF</option>
            <option class="form-control" value="3/OFF">3/OFF</option>
            <option class="form-control" value="Deck Cadet">Deck Cadet</option>
            <option class="form-control" value="O/S">O/S</option>
            <option class="form-control" value="Messman">Messman</option>
            <option class="form-control" value="Chief Engineer">Chief Engineer</option>
            <option class="form-control" value="Engine Cadet">Engine Cadet</option>
          </select> 
        </div>
            
            
            
             <div class="form-group">
                <label for="srn">SRN</label>
                <input type="text" class="form-control" id="srn" name="srn" placeholder="Enter your SRN (Optional)">
            </div>
            
             <div class="form-group">
                <label for="srn">Email</label>
                <input type="text" class="form-control" id="activeemail" name="activeemail" placeholder="Enter your Email" Required>
            </div>
            
            <div class="form-group">
                <label for="mobilenumber">Mobile Number</label>
                <input type="number" class="form-control" id="mobilenumber" name="mobilenumber" placeholder="09*********" Required>
            </div>
            
            <div class="form-group">
                <label for="homeaddress">Home Address</label>
                <input type="text" class="form-control" id="homeaddress" name="homeaddress" placeholder="Enter Your Address" Required>
            </div>
            
            
            <h3 style="background-color: blue; text-align: center; color: white;">Endorsement (Optional)</h3>
           
              <div class="form-group">
                <label for="endorsedname">Endorsed By:</label>
                <input type="text" class="form-control" id="endorsedname" name="endorsedname" placeholder="Enter Endorsed By (Optional)">
            </div>
            
             <div class="form-group">
                <label for="endorsedcompany">Company Name:</label>
                <input type="text" class="form-control" id="endorsedcompany" name="endorsedcompany" placeholder="Enter Company Name (Optional)">
            </div>
             
  


    <!--
             <div class="form-group">
           <label for="datepick2">Select Exam Date</label>
          <input type="text" class="form-control" id="datepick2" name="datepick2" placeholder="Enter the Exam Date" Required>
          </div>
    -->



<!--
     <div class="form-group">
           <label for="accesstype">Select Access</label>
          <select class="form-control" id="accesstype" name="accesstype" style="font-weight: bold; color:#000;">
   <option class="form-control" value="User">User</option>
  </select> 
  </div>
  
  -->
    <button type="submit" class="btn btn-primary btn-large" value="submit" name="submit">Next</button>


        </form>
    </div>
     </div>
 <?php if(isset($_POST['submit'])){
$fetchqry = "SELECT * FROM `user_data`";
$result=mysqli_query($con,$fetchqry);
$num=mysqli_num_rows($result);
@$id = $num + 1;
@$username = "";
@$password = "";
@$completename = $_POST['firstname']. " " . $_POST['middlename'] . " " . $_POST['lastname'] ;
@$viewtype = $_POST['viewtype'];
@$access = 'no'; 
@$accesstype = 'User'; 
@$firstname = $_POST['firstname'];
@$middlename = $_POST['middlename'];
@$lastname = $_POST['lastname'];
@$birthdate = $_POST['datepick1'];
@$birthplace = $_POST['birthplace'];
@$currentrank = $_POST['currentrank'];
@$srn = $_POST['srn'];
@$activeemail = $_POST['activeemail'];
@$mobilenumber = $_POST['mobilenumber'];
@$homeaddress = $_POST['homeaddress'];
@$endorsedname = $_POST['endorsedname'];
@$endorsedcompany = $_POST['endorsedcompany'];
@$sessionme = '1'; 
$qry = "INSERT INTO `user_data`(`username`, `password`, `completename`, `viewtype`, `access`, `session` , `accesstype`, `firstname`, `middlename`, `lastname`, `birthdate`, `birthplace`, `currentrank`, `srn`, `activeemail`, `mobilenumber`, `homeaddress`, `endorsedname`, `endorsedcompany`) VALUES ('$username','$password','$completename','$viewtype','$access','$sessionme', '$accesstype', '$firstname', '$middlename', '$lastname', '$birthdate','$birthplace','$currentrank','$srn','$activeemail','$mobilenumber','$homeaddress','$endorsedname','$endorsedcompany')";
$done = mysqli_query($con,$qry);
if($done==TRUE){
  //  echo "Data Has been added";
}
else 
{
    echo "ERROR: Could not able to execute.";
     /* echo "ERROR: Could not able to execute.". mysqli_error($con) ; */
}

require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'shu17.unified-servers.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@invictusreviewcenter.com';                 // SMTP username
$mail->Password = 'navi@6815';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('info@invictusreviewcenter.com', 'INVICTUS APPLICATION');
$mail->addAddress('kaelsia@yahoo.com');     // Add a recipient
$mail->addAddress('invictusreview@gmail.com');   
$mail->addAddress('nathaliaisip@invictusreviewcenter.com'); // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Website Application for INVICTUS <'.  $completename . '>' ;
$mail->Body    =  '<p> Review for: '. $viewtype .'</p>'.
                  '</br>'.
                  '<p>Complete Name: '. $completename .'</p>'.
                  '<p>Contact number: '. $mobilenumber . '</p>'.
                  '<p>Current Rank: '. $currentrank . '</p>'.
                   '<p>Birthplace: '. $birthplace . '</p>'.
                   '<p>Birthdate: '. $birthdate . '</p>'.
                   '<p>Home Address: '. $homeaddress . '</p>'.
                  '<p> Endorsed by: '. $endorsedname .'</p>'.
                  '<p> Endorsed by Company: '. $endorsedcompany .'</p>'.
                  '</br>'.
                  '<p> MESSAGE: Enrollment on website</p>'.
                  '<p>Email Address: '. $activeemail . '</p>'.
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   // echo 'Message could not be sent.';
  //  echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {
   // echo 'Message has been sent';
}

 echo '<script> 
window.location.replace("thankyoumessage.php");
</script> 
	';




     }
?>
