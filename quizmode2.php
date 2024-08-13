<?php 
include 'forcookie.php';
include 'trainingsphp/trainingsload.php';
include 'modules.php';
include 'loadtables.php'; 
include 'loadfunction.php'; 
@$myusername = $_COOKIE['usname']; 
@$theclassno = $_GET['course'];
@$theaverage = loadtextreturn("onlinetrainings","average","Where traineeid Like '$myusername' and classcode Like '$theclassno'");

if ($theaverage =="")
{
  loadquizfirsttime($theclassno);
}
else 
{
  @$average = intval($theaverage); 

    if($average <75)
    {
      loadquizfirsttime($theclassno);
    }
}

?> 

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class='no-js lt-ie9 lt-ie8 lt-ie7'> <![endif]-->
<!--[if IE 7]>         <html class='no-js lt-ie9 lt-ie8'> <![endif]-->
<!--[if IE 8]>         <html class='no-js lt-ie9'> <![endif]-->
<!--[if gt IE 8]>      <html class='no-js'> <!--<![endif]-->
<html>
    <head>

        <style>
            .questionstyle 
            {
                padding-left: 150px;
                padding-right: 150px;
                border-style: solid;
            }

            .choicesstyle 
            {
                padding-left: 20px;
                margin-top: 5px;
            }


            .noselect {
              -webkit-touch-callout: none; /* iOS Safari */
                -webkit-user-select: none; /* Safari */
                -khtml-user-select: none; /* Konqueror HTML */
                  -moz-user-select: none; /* Old versions of Firefox */
                    -ms-user-select: none; /* Internet Explorer/Edge */
                        user-select: none; /* Non-prefixed version, currently
                                              supported by Chrome, Edge, Opera and Firefox */
             }

   
        </style>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title></title> 
        <meta name='description' content=''>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css'>
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
        
        <script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js'></script> 
        <script src='https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js'></script>	
        
        




      <script>

        function sendanswer()
        {

                  
                  $('#ajaxloading2').show();
                  document.getElementById("buttonnext").disabled = true;
                  document.getElementById("buttonprev").disabled = true;
                  var myanswer = $("input[name='radiochoices']:checked").val();
                  var mynumber = $("#questionno").val();
                  var mycode = $("#quizcode").val();
                  var totalquestion = $("#totalquestion").val(); 
                  $.post("quizsubmit2.php",
                  {
                    choiceanswer:myanswer,
                    choicenumber:mynumber, 
                    choicecode: mycode
                  },function(result){

                    var newadded = 0; 
                    newadded = parseInt(mynumber) + 1; 
                    if(parseInt(newadded)<=parseInt(totalquestion))
                    {
                         document.getElementById("buttonnext").disabled = false;
                         document.getElementById("buttonprev").disabled = false;
                          $('#ajaxloading2').hide();
                          var newvalue= document.getElementById('questionno');
                          newvalue.value = newadded;
                          document.getElementById('mycurrentquestion').innerHTML = "Current Question: " + newadded + " To " + totalquestion; 

                      
                          $('#reloadquestion').empty();
                          $('#reloadquestion').append(result);
                    }
                    else 
                    {
                      document.getElementById("buttonnext").disabled = false;
                      document.getElementById("buttonprev").disabled = false;
                      $('#ajaxloading2').hide();
                      $('#buttonnext').hide();
                      $('#buttonprev').hide();
                      $('#buttonreturn').show();
                      $('#buttonretake').show();
                      $('#reloadquestion').empty();
                      $('#reloadquestion').append(result);
                    }
                  });

        }

        function prevanswer()
        {
                  $('#ajaxloading2').show();
                  document.getElementById("buttonprev").disabled = true;
                  document.getElementById("buttonnext").disabled = true;
                  var myanswer = $("input[name='radiochoices']:checked").val();
                  var mynumber = $("#questionno").val();
                  var mycode = $("#quizcode").val();
                  var totalquestion = $("#totalquestion").val(); 
                  $.post("quizsubmit2.php",
                  {
                    choiceanswer:myanswer,
                    choicenumber:mynumber, 
                    choicecode: mycode
                  },function(result){

                    var newadded = 0; 
                    newadded = parseInt(mynumber) - 1; 
                      
                    if(parseInt(newadded)>0)
                    {
                        document.getElementById("buttonprev").disabled = false;
                        document.getElementById("buttonnext").disabled = false;
                         $('#ajaxloading2').hide();
                          var newvalue= document.getElementById('questionno');
                          newvalue.value = newadded;
                          document.getElementById('mycurrentquestion').innerHTML = "Current Question: " + newadded + " To " + totalquestion; 

                      
                          $('#reloadquestion').empty();
                          $('#reloadquestion').append(result);
                    }
                    else 
                    {
                      document.getElementById("buttonprev").disabled = false;
                      document.getElementById("buttonnext").disabled = false;
                      $('#ajaxloading2').hide();
                       alert("Already the first question");
                    }
                  });

        }


        function returnme()
        {
            window.location.replace("training.php");
        }


        function showexam(classno)
        {
          document.getElementById("buttonverify").disabled = true ;
          $('#ajaxloading1').show();
          $.post("quizchecking.php",
          {
            classnumber:classno
          },function(result)
          {
            if(result==1)
            {
              document.getElementById("buttonverify").disabled = false ;
              $('#buttonverify').hide();
              $('#examform').show();
              $('#mainform').hide();
              $('#ajaxloading1').hide();
            }
            else 
            {
              document.getElementById("buttonverify").disabled = false ;
              $('#buttonverify').hide();
              $('#resultverify').show();
              $('#resultverify').empty(); 
              $('#ajaxloading1').hide();
              $('#resultverify').append(result); 
           } 
          }); 

        }





        $(document).ready(function() 
        {

            $('#buttonreturn').hide();
            $('#buttonretake').hide();
            $('#examform').hide();
            $('#resultverify').hide();
            $('#ajaxloading1').hide();
            $('#ajaxloading2').hide();
            
          var table = $('.mydatatable').DataTable();
              $('.mydatatable tbody').on( 'click', 'tr', function ()
              {
                if ( $(this).hasClass('selected') ) 
                {
                    $(this).removeClass('selected');
                }
                else 
                {
                      table.$('tr.selected').removeClass('selected');
                      $(this).addClass('selected');
                }
              });
          
        });
          


      </script>



    </head>
    
    
    
<?php include 'navbardefault2.php';   ?> 

  <div id="mainform"  class='container' style='margin-top: 40px;'>
  <div class='row'>
    <h5> To Start your exam, please click the button below</h5>
  </div>

  <div class='row' id='resultverify'>
    <p > Unable to start this examination</p>
  </div>

  <div class='row' style="margin-top:10px;">
  <button type='button' id="buttonverify" class='btn btn-success' onclick="showexam('<?php echo $_GET['course'];?>')">
          Start
  </button>
  </div>

  <div class='row' style="margin-top:10px;">
  <p id="ajaxloading1"><img src="image/ajax-loader.gif"/> Please wait </p>
  </div>

  </div>

  <div id="examform" class='container' style='margin-top: 40px;'>

    <div class='row'>
      <?php
      @$coursecode = $_GET['course']; 
      $code = loadcompletecoursecode($coursecode); 
      
      @$coursename = loadcompletecoursename($code); 

      echo " 
      <p>Quiz: <input type='hidden' id='quizcode' value='$coursecode'>$coursename</input></p>
      "; 
      ?>
      </div> 

    <div class='row'>
    <input type='hidden' id='questionno' value='1'></input>
    <input type='hidden' id='totalquestion' value="
    <?php
         $code  = $_GET['course']; 
         $mysession = loadmysession($_COOKIE['usname'],  $code ); 
         @$mytotalquestion = loadmytotalquestions($code,$mysession);
         @$myshow = "". $mytotalquestion; 

     echo $mytotalquestion; 

    ?>
    ">
  </input>
    <p id='mycurrentquestion'> Current Question: 1 to 
    <?php
         $code  = $_GET['course']; 
         $mysession = loadmysession($_COOKIE['usname'],$code); 
         
         @$mytotalquestion = loadmytotalquestions($code,$mysession);
         @$myshow = "". $mytotalquestion; 

     echo "$myshow</p>"; 

    ?>
    
    </div> 



    <div class='row justify-content-md-center'>

    </div> 

    <div id="reloadquestion"> 
      <?php 
      $code  = $_GET['course']; 
      $mysession = loadmysession($_COOKIE['usname'],  $code ); 


      @$myusername = $_COOKIE['usname']; 
      @$theclassno = $_GET['course'];
      @$theaverage = loadtextreturn("onlinetrainings","average","Where traineeid Like '$myusername' and classcode Like '$theclassno'");

      if ($theaverage =="")
      {
        loadmyquestion(0,$code,$mysession);
      }
      else 
      {
          @$average = intval($theaverage); 
          if($average <75)
          {
            loadmyquestion(0,$code,$mysession);
          }
      }


    


      ?>
    </div>

 
      <div class='row justify-content-md-left' style='margin-top: 10px;'>

         <button type='button' id="buttonprev" class='btn btn-primary' onclick='prevanswer()'>
          Previous
          </button>

          <button type='button' style="margin-left: 10px;" id="buttonnext" class='btn btn-info' onclick='sendanswer()'>
          Next
          </button>
      </div>

      <div class='row' style="margin-top:10px;">
      <p id="ajaxloading2"><img src="image/ajax-loader.gif"/>Submitting answer</p>
      </div>


      <div class='row justify-content-md-left' style='margin-top: 10px;'>
          <button type='button' id="buttonreturn" class='btn btn-primary' onclick='returnme()'>
          Return to Main page
          </button>
          <button type='button' id="buttonretake" style="margin-left:10px;" class='btn btn-danger' onclick="window.location.reload();">
       Re-take
          </button>
      </div>

      <div class='row justify-content-md-left' style='margin-top: 10px;'>
          
      </div>
     

     

     

    <div class='md-6' style='margin-top: 50px;'>

    


              
    </div>


  </div>

  



</html>