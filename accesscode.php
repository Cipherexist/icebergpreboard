<?php 
    require 'PHPMailer/PHPMailerAutoload.php';
    include 'modules.php'; 
  require 'dbconfig.php';
 @$email = $_COOKIE['usname'];
//@$email = "mis@navigatormaritime.com"; 

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$mysql = "Select * from examapproved Where email Like '$email' and onlineactivated Like 'yes'";
$dbt = mysqli_query($con,$mysql); 

if (!mysqli_error($con))
{

    if(mysqli_num_rows($dbt)!=0)
    {
        echo '<script> window.location.replace("index.php")</script>';

    }
    else 
    {

        @$randomstring = generateRandomString(5);
        $mail = new PHPMailer;
        // Set mailer to use SMTP
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'shu17.unified-servers.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@icebergmaritimesolutions.com';                 // SMTP username
        $mail->Password = 'jayvee@2442814';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;    
        
        
        $mail->setFrom('info@icebergmaritimesolutions.com', 'Activate Online - Iceberg Maritime');
        $mail->addAddress($email);     // Add a recipient 
        //  $mail->addAddress('mmvalerio@navigatormaritime.com');  
        // $mail->addAddress('mis@navigatormaritime.com');  
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        //$mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = "(NO REPLY) NEW ONE TIME PASSWORD" ;
        $mail->Body    =  "<h4> Hello, Thank you for Registering in online Icerberg Maritime</h4>
          <p> Your One time password is: <b> $randomstring </b></p>" . 
          "</br><p> return to website and type this One time password</p>".
            $mail->AltBody = 'Iceberg@2022';
        
        if(!$mail->send()) 
        {
        // echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
        
        } 
        else 
        {
            require 'dbconfig.php';
            $updatesql = "UPDATE `examapproved` set `otp`='$randomstring' Where email Like '$email'";
            mysqli_query($con,$updatesql); 
            if(mysqli_error($con))
            {
                echo mysqli_error($con);
            }
        
        
        
        
        // echo 'Data has been saved';
        // echo '<script> window.location.replace("thankyoumessage.php")</script>'; 
        //echo "<p style='color: blue;'> Your Password Has Been Sent to Email </p>";
        }
    }
}
else 
{
    echo mysqli_error($con);
}









?> 






<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/mystyleall.css">

<script>

$(document).keypress(function(e) {
    if(e.which == 13) {
        loginfunction();
        
    }
});




function functionpassword()

{
    document.getElementById("result2").innerHTML = "<div class='form-group'>  Please wait.. while we process your request </div>";
    document.getElementById("myBtn").value = "Please wait...";

    var myemailaddress = $("#emailaddress").val(); 


    $.post("accesscode_verification.php",
    {
      passcode: myemailaddress
    },function(result)
    {
    
    if(result == 1)
    {
        window.location.replace("index.php")  
    }
    else 
    {
$('#result2').empty();
    $('#result2').append(result);  


    }
   
    }); 




}

function verification() 
{ 
    document.getElementById("result2").innerHTML = "<div class='form-group'>  Please wait.. while we process your request </div>";
    document.getElementById("myBtn").value = "Please wait...";
  // document.getElementById("myBtn").disabled = true;
    
     var thecode=$("#verifycode").val();
  
  
  $.post("credentials-verify.php",
    {
        mycode:thecode,
    }
    ,function(result){
        
    $('#result2').empty();
    $('#result2').append(result);
      
    });
} 
</script> 
        <style>
body {
    margin: 0;
    padding: 0;
    background-color:aliceblue;
    background-image: url("image/PAM.jpg");
    background-repeat: no-repeat;
    background-size:cover;
    height: 100%;
    width: 100%;
  }
  #login .container #login-row #login-column #login-box {
    padding-top: 10dp;
    margin-top: 10px;
    max-width: 600px;
    height: 420px;
    border: 1px solid #9C9C9C;
    background-color: #EAEAEA;
  }
  #login .container #login-row #login-column #login-box #login-form {
    padding: 20px;
  }
  #login .container #login-row #login-column #login-box #login-form #register-link {
    margin-top: -85px;
  }
            
        </style>




    </head>

    <!------ Include the above in your HEAD tag ---------->
    
    <body>
        <div id="login">
            <h3 class="text-center text-white pt-5"></h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                             <div class="form-group" style="margin-top: 20px;">
                                <h3 class="text-center text-primary" style="color: black">We've Sent you an One Time Password to</h3>
                                <p class="text-center text-primary" style="color:red"><?php echo $email ?></p>
                                <p class="text-center text-info" style="color:red">Please check your email inbox or Spam</p>
                                <p class="text-center text-danger" style="color:red">Note: Sharing of access is PROHIBITED!, it can be trace which will lead to termination of online access</p>
                               
                                <div class="form-group">
                                    <label for="emailaddress" class="text-secondary">Enter Your One Time Password</label><br>
                                    <input type="text" name="emailaddress" id="emailaddress" class="form-control">
                                </div>
                                

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-large" style="margin-top:10px;" value="submit" name="submit" id="myBtn" onclick="functionpassword()">Submit</button>
                                    <a href="login.php" class="btn btn-danger btn-large" style="margin-top:10px;" >Cancel</a>
                                </div>

                                <div id="result2" class="form-group"> 
                                </div>
                               
                           
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>