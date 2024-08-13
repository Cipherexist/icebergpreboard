<?php 
include 'dbconfig.php'; 
date_default_timezone_set('ETC/GMT+8');

function loadregistrationdatetoday()
{
	$myyear = date('Y'); 
	$mydate = date('d'); 
	$mymonth = date('m'); 
		
	
	$completeregdate = $myyear. $mymonth. $mydate; 
	
	return $completeregdate; 
}

function loadcompletecoursename($codes)
{
		include 'dbconfig.php'; 
		$query = "Select * from codes Where codes Like '". $codes. "'";
		$datame = mysqli_query($con, $query);

		if(!mysqli_error($con))
		{
			if(mysqli_num_rows($datame)!=0)
			{
				while($row = mysqli_fetch_assoc($datame)) 
				{
				$codecomplete = $row["coursename"]; 
				}
			}
			else 
			{
				$codecomplete = "";
			}
		}
		else 
		{
			$codecomplete = "";
		}

		
	    return $codecomplete;
}

function loadcourseslide($codes)
{
		include 'dbconfig.php'; 

		$totalslides = "none"; 
		$query = "Select * from codes Where codes Like '". $codes. "'";
		$datame = mysqli_query($con, $query);

		if(!mysqli_error($con))
		{
			if(mysqli_num_rows($datame)!=0)
			{
				while($row = mysqli_fetch_assoc($datame)) 
				{
				$totalslides = $row["totalslides"] - 1; 
				}
			}
			else
			{
				
				$totalslides = "none"; 
			}
		}
		else 
		{
			$totalslides = mysqli_error($con); 
		}
		
	    return $totalslides;
}

function loadcoursetotalslides($classno)
{
    include 'dbconfig.php'; 

    $myresult = 0; 

    @$mycode = loadcompletecoursecode($classno); 

    $query = "Select * from codes Where Codes Like '$mycode'"; 
    $dbt = mysqli_query($con,$query); 


    if(!mysqli_error($con))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            $row = mysqli_fetch_assoc($dbt); 
            $myresult = $row['totalslides'];
        }
        else 
        {
            $myresult = 0; 
        }
    }
    else 
    {
        echo mysqli_error($con); 
    }
    
    return $myresult; 
}

function loadcoursemyreadingpercent($classno)
{
    include 'dbconfig.php'; 

    $myresult = 0; 

    @$mycode = $classno;
    @$username = $_COOKIE['usname']; 

    $query = "Select * from onlinetrainings Where classcode Like '$mycode' AND traineeid Like '$username'"; 
    $dbt = mysqli_query($con,$query); 


    if(!mysqli_error($con))
    {
        if(mysqli_num_rows($dbt)!=0)
        {
            $row = mysqli_fetch_assoc($dbt); 
            $myresult = $row['readingpercent'];
        }
        else 
        {
            $myresult = $query; 
        }
    }
    else 
    {
        echo mysqli_error($con); 
    }
    
    return $myresult; 
}




function loadcompletecoursecode($classno)
{
		include 'dbconfig.php'; 
		$query = "Select * from availdates Where classno Like '". $classno. "'";
		$datame = mysqli_query($con, $query);
		$codecomplete = ""; 

		if(!mysqli_error($con))
		{
			if(mysqli_num_rows($datame)!=0)
			{
				while($row = mysqli_fetch_assoc($datame)) 
				{
				$codecomplete = $row["Codes"]; 
				}
			}
			else 
			{
				$codecomplete = ""; 
			}
		}
		else 
		{
			$codecomplete = "";
		}

	    return $codecomplete;
}




function loadcoursefee($codes)
{
		include 'dbconfig.php'; 
		$query = "Select * from codes Where codes Like '". $codes. "'";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$codefee = $row["promorate"]; 
 			}
		}
		
	    return $codefee;
}

function loadinstructorcompletename($inscode)
{
	include 'dbconfig.php'; 
	$query = "Select * from instructordetails Where instructorcode Like '". $inscode. "'";
	$datame = mysqli_query($con, $query);

	if(!mysqli_error($con))
	{
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$insname = $row["instructorname"]; 
			}
		}
	}
	else
	{
		echo mysqli_error($con);
	}
	return $insname;

}

function loadregistrationtocompletedate($registrationdate) 
{
	
	if(strlen($registrationdate) >= 8)
	{
		$myyear = substr($registrationdate,0,4);
		$mymonth = substr($registrationdate,4,2);
		$myday = substr($registrationdate,6,2);
		
		
	if((int)$mymonth==1)
	{
$myconvmonth = "January";
	}
	elseif((int)$mymonth==2)
	{
$myconvmonth = "February";
	}
	elseif((int)$mymonth==3)
	{
$myconvmonth = "March";
	}
	elseif((int)$mymonth==4)
	{
$myconvmonth = "April";
	}
	elseif((int)$mymonth==5)
	{
$myconvmonth = "May";
	}
	elseif((int)$mymonth==6)
	{
$myconvmonth = "June";
	}
	elseif((int)$mymonth==7)
	{
$myconvmonth = "July";
	}
	elseif((int)$mymonth==8)
	{
$myconvmonth = "August";
	}
	elseif((int)$mymonth==9)
	{
$myconvmonth = "September";	
	}
	elseif((int)$mymonth==10)
	{
$myconvmonth = "October";	
	}
	elseif((int)$mymonth==11)
	{
$myconvmonth = "November";
	}
	elseif((int)$mymonth==12)
	{
$myconvmonth = "December";	
	}
		
		
	$mycompletedate = $myconvmonth. ' ' . $myday . ', ' . $myyear; 
	return $mycompletedate; 
	
	} 
} 




function loadregistrationtime()
{

	$completetime = date("s"); 
	
	return $completetime; 
}





function loadtextreturn($selecttable, $itemtoshow, $sqlstat)
{	
		include 'dbconfig.php'; 

		$query = "Select * from " .$selecttable. " ". $sqlstat ;
		$datame = mysqli_query($con, $query);
		$datereturn = ""; 
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$datereturn = $row[$itemtoshow];
			break; 		
			}
		}
		return $datereturn; 
}




function loadcompletetrainingdate($classno)
{
		$fdate =""; 
		$ldate =""; 
		$ftime=""; 
		$ltime=""; 
		include 'dbconfig.php';
		$query = "Select * from availdates Where classno Like '". $classno. "' ORDER BY formonth DESC";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$fdate = $row["datestart"]; 
 			}
		}
	
     	$query = "Select * from availdates Where classno Like '". $classno. "' ORDER BY formonth ASC";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$ldate = $row["datestart"]; 
			$ftime = $row["timestart"];  
			$ltime = $row["timeend"];  
 			}
		}
		
	    return $fdate. " - " . $ldate. "(" .$ftime. "-" .$ltime. ")";
}


function loadcoursefirstdate($classno)
{
		$fdate =""; 
		$ldate =""; 
		$ftime=""; 
		$ltime=""; 
		include 'dbconfig.php';
		$query = "Select * from availdates Where classno Like '". $classno. "' ORDER BY formonth DESC";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$fdate = $row["formonth"]; 
 			}
		}
	
  
		
	    return $fdate;
}

function loadcourselastdate($classno)
{
		$fdate =""; 
		$ldate =""; 
		$ftime=""; 
		$ltime=""; 
		include 'dbconfig.php';
		$query = "Select * from availdates Where classno Like '". $classno. "' ORDER BY formonth ASC";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$fdate = $row["formonth"]; 
 			}
		}
	
  
		
	    return $fdate;
}




function loadcompletename()
{

		include 'dbconfig.php'; 
        @$username  = $_COOKIE['usname']; 
        @$password = $_COOKIE['psword'] ; 
        $completename= ""; 

     	$query = "Select * from onlinetrainee Where username Like '$username' and password like '$password'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $completename = $row["completename"]; 
 			}
		}
		
	    return $completename; 
}


function loadcompletenamebytraineecode($traineecode)
{

		include 'dbconfig.php'; 
        $completename= ""; 

     	$query = "Select * from onlinetrainee Where traineecode Like '$traineecode'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $completename = $row["completename"]; 
 			}
		}
		
	    return $completename; 
}


function loadtraineeusername($traineecode)
{

		include 'dbconfig.php'; 
        $completename= ""; 

     	$query = "Select * from onlinetrainee Where traineecode Like '$traineecode'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $completename = $row["username"]; 
 			}
		}
		
	    return $completename; 
}



function loadtraineepassword($username)
{

		include 'dbconfig.php'; 
        $completename= ""; 

     	$query = "Select * from onlinetrainee Where username Like '$username'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $completename = $row["password"]; 
 			}
		}
		
	    return $completename; 
}


function loadcompletenametraineecode($traineecode)
{

		include 'dbconfig.php'; 
        @$tc  = $traineecode; 
        $completename= ""; 

     	$query = "Select * from onlinetrainee Where traineecode Like '$tc'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $completename = $row["completename"]; 
 			}
		}
		
	    return $completename; 
}



function loadiffinal()
{

		include 'dbconfig.php'; 
        @$username  = $_COOKIE['usname']; 
        @$password = $_COOKIE['psword'] ; 
        $finalsubmit= ""; 

     	$query = "Select * from onlinetrainee Where username Like '$username' and password like '$password'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $finalsubmit = $row["finalsubmit"]; 
 			}
		}
		
	    return $finalsubmit; 
}

function loadifnopicture()
{

		include 'dbconfig.php'; 
        @$username  = $_COOKIE['usname']; 
        @$password = $_COOKIE['psword'] ; 
        $pictureloc= ""; 

     	$query = "Select * from onlinetrainee Where username Like '$username' and password like '$password'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $pictureloc = $row["pictureloc"]; 
 			}
		}
		
	    return $pictureloc; 
}






function loadtraineecompletename($username)
{

		include 'dbconfig.php'; 
        $completename= ""; 

     	$query = "Select * from onlinetrainee Where username Like '$username'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $completename = $row["completename"]; 
 			}
		}
		
	    return $completename; 
}

function generatetraineecode($lastname)
{ 
	$lastnamegen = strtoupper(substr($lastname,0,1));
	$useext = ""; 
	$trysearch = "";  
	$traineecodereturn = ""; 
	$startcount =0; 
	$strtotal = 0; 

	include 'dbconfig.php'; 

	$useext =""; 
	$trysearch = "" .$lastnamegen; 
	$startcount =1; 
	$traineecodeme  = ""; 

	$query = "Select * from trainee Where traineecode Like '" . $trysearch ."%' ORDER BY ID DESC";
			$datame = mysqli_query($con, $query);
			if(mysqli_num_rows($datame)!=0)
			{	
			$traineecodeme = loadtextreturn("trainee","traineecode","Where traineecode Like '" . $trysearch ."%' ORDER BY ID DESC");
			$mylenght = strlen($traineecodeme);
			$strtotal = $mylenght - $startcount; 
			
			$x = substr($traineecodeme,$startcount,$strtotal) + 1; 
			$traineecodereturn = $trysearch. loadnumberdecimalpoints($x,2); 
				while($row = mysqli_fetch_assoc($datame)) 
				{
				if($traineecodereturn == $row["traineecode"])
				{
					$x +=1; 
					$traineecodereturn = $trysearch. loadnumberdecimalpoints($x,2);  
				}
				else
					{
					break;	
					}					
				}
			}
			else 
			{ 
			$traineecodereturn = $trysearch . "001"; 
			}
	return $traineecodereturn ; 
}

function loadnumberofdataall($table,$wherestr)
{ 
include 'dbconfig.php'; 

$returnmyno = 0; 
$query1 = "Select * from ".$table ." ".$wherestr;
//echo "LOADTOTAL: " . $query1; 

$datame = mysqli_query($con, $query1);
	if(!mysqli_error($con))
	{
		if(mysqli_num_rows($datame)!=0)
		{	
			
		$returnmyno = mysqli_num_rows($datame); 

		}
		else 
		$returnmyno = 0; 

	}
	else
	{
		$returnmyno = mysqli_error($con);
	}
	return $returnmyno; 
}

function generateregistrationnumber()
{
	@$regtoday = loadregistrationdatetoday(); 
	$totalall = loadnumberofdataall("monitor","Where regdate like '$regtoday'"); 
	$totalsum = $totalall + 1; 
	$convertedsum = loadnumberdecimalpoints($totalsum,2); 
	$result = $regtoday . "-" . $convertedsum; 
	$mynumberofdata = loadnumberofdataall("monitor","Where regno like '$result'");
	
	While($mynumberofdata == 1)
	{
		$totalsum = $totalsum + 1;
		$convertedsum = loadnumberdecimalpoints($totalsum,2); 
		$result = $regtoday . "-" . $convertedsum; 
		$mynumberofdata = loadnumberofdataall("monitor","Where regno like '$result'");
	
	}

    return $result; 

}



function loadnumberdecimalpoints($yourno, $decimalpoints)
{
	$setofzero1 = ""; 
	$setofzero2 = ""; 
	$setofzero3 = ""; 
	$returnmyzero = "0"; 
	
	if($decimalpoints==3)
	{ 
		$setofzero1="000"; 
		$setofzero2="00"; 
		$setofzero3="0"; 
	}
	
	if($decimalpoints==2)
	{ 
		$setofzero1="00"; 
		$setofzero2="0"; 
		$setofzero3=""; 
	}
	
	if($decimalpoints==1)
	{ 
		$setofzero1="0"; 
		$setofzero2=""; 
		$setofzero3=""; 
	}
	
	
	if ($yourno >=0 && $yourno <=9)
	{
		$returnmyzero = $setofzero1 . $yourno; 
	}
	else if($yourno >=10 && $yourno <=99)
	{
		$returnmyzero = $setofzero2 . $yourno; 
	}
	else if($yourno >=100 && $yourno <=999)
	{
		$returnmyzero = $setofzero3. $yourno; 
	}
	else if($yourno >=1000)
	{
		$returnmyzero =  $yourno; 
	}
	
	return $returnmyzero; 
	
}


function updatesession($email)
{
  include 'dbconfig.php'; 



}



function loadmysession($email)
{
		@$myemail = $email; 

		include 'dbconfig.php'; 
     	$query = "Select * from examapproved Where email Like '$myemail'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
        
			if ($row["session"] == "") 
			{
				$mysession = "1"; 
			}
			else 
			{
				$mysession = $row["session"]; 
			} 
		
            return $mysession; 

 			}
		}
        else 
        {
            echo "SESSION: " . $query;
        }	
}

function loadmystatus($classno)
{

		include 'dbconfig.php'; 
		$mycode = $classno;
		@$username = $_COOKIE['usname']; 
     	$query = "Select * from onlinetrainings Where traineeid Like '$username' and classcode Like '$mycode'";
		$datame = mysqli_query($con, $query);
		
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
            $mystatus = $row["status"]; 
            return $mystatus; 
 			}
		}
        else 
        {
            echo "SESSION: " . $query;
        }	
}













?>