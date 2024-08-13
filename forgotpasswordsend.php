    <?php 
    require 'PHPMailer/PHPMailerAutoload.php';
    include 'modules.php'; 




    @$email = $_POST['emailaddress']; 

    @$mypassword = loadtextreturn("onlinetrainee","password","Where email like '$email'"); 

if(!empty($mypassword))
{
    $mail = new PHPMailer;
    // Set mailer to use SMTP
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'shu17.unified-servers.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@icebergmaritimesolutions.com';                 // SMTP username
    $mail->Password = 'jayvee@2442814';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;    


    $mail->setFrom('info@icebergmaritimesolutions.com', 'ICEBERG MARITIME');
    $mail->addAddress($email);     // Add a recipient 
    //  $mail->addAddress('mmvalerio@navigatormaritime.com');  
    // $mail->addAddress('mis@navigatormaritime.com');  
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    //$mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = "Your Forgot Password (Navigator Account)" ;
    $mail->Body    =  "<h4> Hello, Thank you for Registering in online Navigator System </h4>
      <p> Your old password is: <b> $mypassword </b></p>" . 
      "</br><p> Change your Password after your login </p>".
        $mail->AltBody = 'Navisys@2021';

    if(!$mail->send()) 
    {
    // echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;

    } 
    else 
    {
    // echo 'Data has been saved';
    // echo '<script> window.location.replace("thankyoumessage.php")</script>'; 
    echo "<p style='color: blue;'> Your Password Has Been Sent to Email </p>";
    }

}
else 
{
    echo "<p style='color: red;'> No Account Registered </p>";
}

?> 
