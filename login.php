<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Iceberg Preboard</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- <link rel="stylesheet" href="/css/mystyleall.css"> -->

<script>

$(document).keypress(function(e) {
    if(e.which == 13) {
        loginfunction();
        
    }
});

$(document).ready(function() 
 {
    $('#ajaxloading2').hide();     
});






function loginfunction() 
{ 
    $('#ajaxloading2').show(); // document.getElementById("myBtn").disabled = true;
    document.getElementById("myBtn").disabled = true;
     var usword=$("#username").val();
     var psword=$("#password").val();
  
  
  $.post("credentials.php",
    {
        usname:usword,
        psname:psword
    }
    ,function(result){
    $('#ajaxloading2').hide();
    document.getElementById("myBtn").disabled = false;
    if(result==1)
    {
      window.location.replace("accesscode.php")  
    }
    else if(result ==2)
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
</script> 
        <style>
body {
    margin: 0;
    padding: 0;

    background-color:darkblue;
    background-repeat: no-repeat;
    background-image: url("image/PAM.jpg");
    background-size:cover;
    height: 100%;
    width: 100%;
  }
  #login .container #login-row #login-column #login-box {
    padding-top: 10dp;
    margin-top: 60px;
    max-width: 600px;
    height: 360px;
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
                             <div class="form-group">
                                <h3 class="text-center text-info" style="margin-top: 10px;">User Login</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">Registered Email Address:</label><br>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Email Address">
                                </div>
                                
                                <div class="form-group">
                                    <label for="password" class="text-info">Password / Activation Code:</label><br>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Activation code or password">
                                </div>
                                <div class="form-group">
                                      <a href="forgotpassword.php">Forgot Password, Click Here</a>

                                
                                </div>
                                <div class="form-group">
                                    
                                    <button type="submit" class="btn btn-primary btn-large" style="margin-top:10px;" value="submit" name="submit" id="myBtn" onclick="loginfunction()">Sign-in</button>
                                                                    </div>

                                <div id="result2" class="form-group"> 
                                <p id="ajaxloading2"><img src="image/ajax-loader.gif"/>Please wait while we process your request</p>
                                </div>
                               
                           
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>