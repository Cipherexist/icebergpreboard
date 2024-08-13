<?php
include 'dbconfig.php';
require 'forcookie.php';
require 'loadmodules.php'; 
require 'forcookie2.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Online Quiz">
    <meta name="author" content="Val Okafor">   
    <title>Preboard Accounts</title>

    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
    
    <!--
    <link href="css/theme.css" rel="stylesheet">
   	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   	<link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.css">
   	-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
  <!--
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery-1.10.2.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  -->
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.1/umd/popper.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>	
	
	

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  
  </head>

<style>
</style>


<script>

	$(document).ready(function() 
	{
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
		
		
		
		
function deleteme(classnotext) 
{ 

swal.fire({
  title: 'Delete ' + classnotext + '?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Deactivate'
}).then((result) => {
  if (result.value) {
    
    
    $.post("deleteacct.php",
	{
	usernameme: classnotext
	},function(result){
	      $("#result").empty(); 
      $("#result").append(result); 
		
	});
  }
});

}

function showresult()
{
    
var searchresult  = document.getElementById("searchid").value; 
 
document.getElementById("titleme").value = searchresult;

}


        function loadactivation()
        {
          var id = $("#myid").val(); 
          var thecode = $("#passcode").val(); 
          var thepayment = $("#paymentid").val(); 
          $.post("activate.php",
          {
            myid: id, 
            mycode: thecode, 
            mypayment: thepayment
          },function(result)
          {
           
            if(result==1)
            {
              $("#resultaccess").empty(); 
              $("#resultaccess").append("Please Fill up the text button"); 

            }
            else if(result==2)
            {
              $("#resultaccess").empty(); 
              $("#resultaccess").append("There is an error in your sql"); 

            }
            else 
            {
              $("#result").empty(); 
              $("#result").append(result); 
              $('#modalapprove').modal('hide');

            }
          }); 
        }


        function loadmodalid(theid,completename)
        {
          document.getElementById('completenameid').innerHTML = "ID: " + theid + " Complete Name: " + completename ; 
          document.getElementById('myid').value  = theid; 
       
        }   


          function makeid(length)
         {
          var result           = '';
          var characters       = 'abcdefghijklmnopqrstuvwxyz0123456789';
          var charactersLength = characters.length;
          for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * 
            charactersLength));
         }
           return result;

         }

         function getrandom()
         {
          document.getElementById("passcode").value = makeid(5);
         }

    
</script>

<?php  
include 'navbardefault.php';





?> 
<div class="container">



<div class="modal fade" id="modalapprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalapprove"> <p id="completenameid"></p></h5>
          <input type="hidden" id="myid" name="myid">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 30px;">
         

            <div class="row">
                  <label for="passcode">Set Password</label>
                  <input type="text" name="passcode" id="passcode" class="form-control" placeholder="" aria-describedby="helpId">
          
            </div>

            <div class="row" style="margin-top: 10px;">
              <button id="upload-button" class="btn btn-primary btn-small" onclick="getrandom()">Generate Code</button> 
            </div>

            <div class="row" style="margin-top:10px;">
                 <label for="paymentid">Set Payment</label>
                  <input type="text" name="paymentid" id="paymentid" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>

          
            <div class="row">
              <div class='col-sm-10' id='resultaccess'> 
              </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           <button id="upload-button" class="btn btn-primary btn-large" onclick="loadactivation()"> Activate </button>
        </div>
      </div>
    </div>
    </div>




<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <h1 id="titleme">Android Accounts</h1>
            <div class="form-group">
  
        </div>
        </form>
    </div>
     </div>
	 <?php if(isset($_POST['submit'])){
$fetchqry = "SELECT * FROM `quiz`";
$result=mysqli_query($con,$fetchqry);
$num=mysqli_num_rows($result);
@$id = $num + 1;
@$que = $_POST['question'];
@$ans = $_POST['correct_answer'];
@$wans1 = $_POST['wrong_answer1'];
@$wans2 = $_POST['wrong_answer2'];
@$wans3 = $_POST['wrong_answer3']; 
$qry = "INSERT INTO `quiz`(`id`, `que`, `option 1`, `option 2`, `option 3`, `option 4`, `ans`) VALUES ($id,'$que','$ans','$wans1','$wans2','$wans3','$ans')";
$done = mysqli_query($con,$qry);
if($done==TRUE){
	echo "Question and Answers Sumbmitted Succesfully";
}
	 }
?>


<table class="table table-striped table-bordered mydatatable" style="width: 100%"> 
    	
    	<thead>
        <tr>
        <th> No </th>
        <th> Registered User </th>
        <th> Activation Code </th>
  	    <th> Viewtype </th>
        <th> Email </th>
			 <th> App registered </th>
			   <th> LastLogin </th>
			    <th> Access </th>
			 	 <th> FUNCTION </th>
        </tr>
        </thead>
        
        <tbody id="result">
                <?php 
                include 'showandroiduser.php';
                ?>
        </tbody>
        </table>


</div>


    
</div>
