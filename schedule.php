<!DOCTYPE><head>
<title>Navigator Maritime</title>

<link href="navisys.css" rel="stylesheet" type="text/css" />

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">



 <script src="js/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<link href="js/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-ui.js"></script>




<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="js/bootstrap.min.css">
<!-- Latest compiled and minified JavaScript -->


  <script>

$(function() {
		 
$( "#tabs" ).tabs();
var monthNames = $( "#datepick1" ).datepicker( "option", "monthNames" );

$( "#datepick1" ).datepicker("option", "monthNames", ["Januar", "Februar", "Marts", "April", "Maj", "Juni", "Juli", "August", "September", "Oktober", "November", "December"]);

	$( "#datepick1" ).datepicker({
		shortYearCuroff: 50,
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


	$.post("clientenrollmentload.php",
	{
	fdate: $("#datepick1").datepicker({dateFormat:'dd-MM-yyyy'}).val(),
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


function loadschedules() 
{ 
					
	   document.getElementById("result2").innerHTML = "<th colspan='8' style='background-color: white; color: black; font-family: times new roman; font-size: 24px;font-weight: bold;text-align: center;'>  Loading Schedules for "+ $("#coursename").val() +", Please Wait </th>"
	$.post("showschedule.php",
	{
	coursemonth: $("#coursemonth").val(),
	courseyear: $("#courseyear").val(),
	coursename: $("#coursename").val()
	},function(result){
			$('#result2').empty();
			$('#result2').append(result);	
	});
} 



function loadmodify(classno) 
{
	 document.getElementById("iframerep").innerHTML = '<iframe src="http://119.93.9.252/navigator/schedulemodify.php?classno='+classno+'" style="width:100%; height:100%;" id="iframerep"></iframe>'
}

  </script>
<?php  
include 'navbardefault.php';
?> 






<script> 
$(document).ready(function () {
    $(".popup").hide();
    $(".openpop").click(function (e) {
        e.preventDefault();
        $("iframe").attr("src", $(this).attr('href'));
        $(".links").fadeOut('slow');
        $(".popup").fadeIn('slow');
    });

    $(".close").click(function () {
        $(this).parent().fadeOut("slow");
        $(".links").fadeIn("slow");
    });
});
</script> 


</head>

<body style="padding:5px;">
<div id="divBack" class="container" style="margin-top: 50px;">

<div class="row" style="background-color:#2B90DA; padding: 5px;" >
    <div class="col-sm-6">
        <p class="col-md-2" style="font-weight: bold; color:#000; size:25px; width:auto;" >Course Name:
      <select class="form-control" id="coursename" style="font-weight: bold; color:#000;">
   <option class="form-control" value="Deck Management level"> Deck Management Level</option>
  </select> 
        </p>
    </div>
    
    <div class="col-sm-2">

    </div>  
     <div class="col-sm-2" style="background-color: whitesmoke; padding: 5px;">
        <input type="submit" id="driver" value="SHOW DATA" class="btn btn-primary form-control" onClick="loadschedules();"/>
        <a href="#" id="visitid" data-toggle="modal" data-target="#cidmain" class="btn btn-success form-control" style="margin-top: 2px; ">ADD</a> 
     </div>
    
    
<div class="row" style="padding: 5px;">
    <div class="col-md-12">
       <div class="table-responsive">
                              <table  class="display responsive nowrap" border="1"    cellspacing="0" width="100%" style="margin-top: 25px;border-color:white ;margin-bottom: 25px;">
                                  
                                      <thead style="background-color:Black;color:white;">
                                         
                                            <tr>
                                                <th style="font-size: 16px;font-family: times new roman;font-weight: bold;padding:10px;text-align:center;">CODE</th>
						<th style="font-size: 16px;font-family: times new roman;font-weight: bold;padding:10px;text-align:center;">CLASS No.</th>
                                                <th style="font-size: 16px;font-family: times new roman;font-weight: bold;padding:10px;text-align:center;">COMPLETE DATE & TIME</th>
                                                <th style="font-size: 16px;font-family: times new roman;font-weight: bold;padding:10px;text-align:center;">DAY(s)</th>
					        <th style="font-size: 16px;font-family: times new roman;font-weight: bold;padding:10px;text-align:center;">ROOM</th>
                                                <th style="font-size: 16px;font-family: times new roman;font-weight: bold;padding:10px;text-align:center;">No. OF TRAINEE</th>
                                                <th style="font-size: 16px;font-family: times new roman;font-weight: bold;padding:10px;text-align:center;">CREATED BY</th>
						<th style="font-size: 16px;font-family: times new roman;font-weight: bold;padding:10px;text-align:center;">DATE CREATED</th>
                                            </tr>
                                        </thead>
                                        <tfoot> 
					<tr>
                                        <th  id ="result" colspan="8" style="background-color: white; color: red; font-family: times new roman; font-size: 24px;font-weight: bold;text-align: center;">
					
                                        </th>
					</tr>
                                            
					</tfoot>
					<tfoot id ="result2">
										
					</tfoot>
                                        
									
				</table>
									
                            </div>
    </div>

</div>
    
    
    
         <div class="modal fade" id="cidmain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="width:100%;">
          <div class="modal-dialog"  role="document">
          <div class="modal-content">
               <div class="modal-header" id="TableBackground">
             <button type="button" class="close" data-dismiss="modal" arial-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><p style="font-size: 28px;text-align: center;font-family: times new roman;color: black;font-weight: bolder;">Schedule Modify</p></h4>
                   </div>                      
               <div class="modal-body form-horizontal" id="" style="background-color: #60BFE2;">								  
			<iframe src="http://119.93.9.252/navigator/modifyschedule.php" style="width:100%; height:100%;" id="iframerep"></iframe>
	       </div>
       		<div id = "resultsaving" class="container"> 
 		</div>
           </div>
         </div>
        </div>
    
    
    
    
    
</div>
</div>
</body>
</html>