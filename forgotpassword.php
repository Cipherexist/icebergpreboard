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


    $.post("forgotpasswordsend.php",
    {
      emailaddress: myemailaddress
    },function(result)
    {
    $('#result2').empty();
    $('#result2').append(result);  
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
    margin-top: 80px;
    max-width: 600px;
    height: 250px;
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
                                <h3 class="text-center text-info">Forgot Password</h3>
                                <div class="form-group">
                                    <label for="emailaddress" class="text-info">Enter Your Email Address</label><br>
                                    <input type="text" name="emailaddress" id="emailaddress" class="form-control">
                                </div>
                                

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-large" style="margin-top:10px;" value="submit" name="submit" id="myBtn" onclick="functionpassword()">Submit</button>
                                    <a href="login.php" class="btn btn-warning btn-large" style="margin-top:10px;" >Trainee Log-in</a>
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