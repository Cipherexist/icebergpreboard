<?php 
require 'dbcon.php';
require 'default.php';
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");

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



function loadcompleteinstructorname($instructorcode)
{ 
$query = ""; 
$instructorcompletename = "0"; 

$query = "Select * from instructordetails Where instructorcode Like '" . $instructorcode ."' ORDER BY ID DESC";
		$datame = mysql_query($query);
		if(mysql_num_rows($datame)!=0)
		{	
			while($row = mysql_fetch_assoc($datame)) 
			{
				$instructorcompletename = $row["instructorname"]; 
			}
		}
return $instructorcompletename; 
} 






function generatetraineecode($lastname)
{ 
$lastnamegen = strtoupper(substr($lastname,0,1));
$useext = ""; 
$trysearch = "";  
$traineecodereturn = ""; 
$startcount =0; 
$strtotal = 0; 


if ($_COOKIE['branchcode']=='NAVI-1')
{
$useext =""; 
$trysearch = "" .$lastnamegen; 
$startcount =1; 

}
else if($_COOKIE['branchcode']=='NAVI-2')
{ 
$useext ="ILO"; 
$trysearch ="ILO" .$lastnamegen; 
$startcount =3; 
}
$traineecodeme  = ""; 

$query = "Select * from trainee Where traineecode Like '" . $trysearch ."%' ORDER BY ID DESC";
		$datame = mysql_query($query);
		if(mysql_num_rows($datame)!=0)
		{	
		$traineecodeme = loadtextreturn("trainee","traineecode","Where traineecode Like '" . $trysearch ."%' ORDER BY ID DESC");
		$mylenght = strlen($traineecodeme);
		$strtotal = $mylenght - $startcount; 
		
		$x = substr($traineecodeme,$startcount,$strtotal) + 1; 
		$traineecodereturn = $trysearch. loadnumberdecimalpoints($x,2); 
			while($row = mysql_fetch_assoc($datame)) 
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
$returnmyno = 0; 
$query1 = "Select * from ".$table ." ".$wherestr;
		$datame = mysql_query($query1);
		if(mysql_num_rows($datame)!=0)
		{	
		$returnmyno = mysql_num_rows($datame); 
		}
	return $returnmyno; 
}


function loadcompletetrainingtime($classno) 
{
	
$timestartauto = ""; 
$timeendauto = "";
$completetime = ""; 


$timestartauto = loadtextreturn("availdates","timestart","Where classno Like '". $classno .	"' ORDER BY formonth ASC"); 
$timeendauto = loadtextreturn("availdates","timeend","Where classno Like '". $classno .	"' ORDER BY formonth DESC");
$completetime = "(". $timestartauto .":". $timeendauto . ")"; 
}





function loadcompletetrainingdate($classno)
{
		$fdate =""; 
		$ldate =""; 
		$ftime=""; 
		$ltime=""; 
		
		$query = "Select * from availdates Where classno Like '". $classno. "' ORDER BY formonth ASC";
		$datame = mysql_query($query);
		if(mysql_num_rows($datame)!=0)
		{
			while($row = mysql_fetch_assoc($datame)) 
			{
			$fdate = $row["datestart"]; 
 			}
		}
	
     	$query = "Select * from availdates Where classno Like '". $classno. "' ORDER BY formonth DESC";
		$datame = mysql_query($query);
		
		if(mysql_num_rows($datame)!=0)
		{
			while($row = mysql_fetch_assoc($datame)) 
			{
			$ldate = $row["datestart"]; 
			$ftime = $row["timestart"];  
			$ltime = $row["timeend"];  
 			}
		}
		
	    return $ldate. " - " . $fdate. "(" .$ftime. "-" .$ltime. ")";
}






function loadcompletecoursename($codes)
{
		
		$query = "Select * from codes Where codes Like '". $codes. "'";
		$datame = mysql_query($query);
		if(mysql_num_rows($datame)!=0)
		{
			while($row = mysql_fetch_assoc($datame)) 
			{
			$codecomplete = $row["coursename"]; 
 			}
		}
		
	    return $codecomplete;
}

function loadnumberoftrainee($codes)
{
		
		$query = "Select * from codes Where codes Like '". $codes. "'";
		$datame = mysql_query($query);
		if(mysql_num_rows($datame)!=0)
		{
			while($row = mysql_fetch_assoc($datame)) 
			{
			$codecomplete = $row["coursename"]; 
 			}
		}
		
	    return $codecomplete;
}

function loadcheckifmarinaorinhouse($codes)
{ 
		$query = "Select * from codes Where Codes Like '". $codes. "'";
		$datame = mysql_query($query);
		if(mysql_num_rows($datame)!=0)
		{
			while($row = mysql_fetch_assoc($datame)) 
			{
			 
			 	if($row["coursetype"]=="In house" || $row["coursetype"]=="Marina course")
			 	{
				$checkiftrue = "true";
				}
				else 
				{
				$checkiftrue = "false";	
				} 
				
			
			}
		}

		return $checkiftrue; 
} 





function loadnum($yourno) 
{ 
	$zerostype = ""; 

	if($yourno >= 0 && $yourno <=9)
	{ 
	$zerostype = "0";
	$outcome = $zerostype. $yourno;
	} 
	elseif($yourno >= 10 && $yourno <=99)
	{ 
	$zerostype = "";
	$outcome = $zerostype. $yourno;
	} 
	elseif($yourno >= 100 && $yourno <=999)
	{ 
	$zerostype = "";
	$outcome = $zerostype. $yourno;
	} 
	elseif($yourno >= 1000)
	{ 
	$zerostype = "";
	$outcome = $zerostype. $yourno;
	} 



	return $outcome;
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


function loadregistrationtomonthonly($registrationdate) 
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
		
		
	$mycompletedate = $myconvmonth; 
	return $mycompletedate; 
	
	} 
} 



function loadregistrationtocompletedateforschedule($registrationdate) 
{
	
	if(strlen($registrationdate) >= 8)
	{
		$myyear = substr($registrationdate,0,4);
		$mymonth = substr($registrationdate,4,2);
		$myday = substr($registrationdate,6,2);
		
		
	if((int)$mymonth==1)
	{
$myconvmonth = "Jan";
	}
	elseif((int)$mymonth==2)
	{
$myconvmonth = "Feb";
	}
	elseif((int)$mymonth==3)
	{
$myconvmonth = "Mar";
	}
	elseif((int)$mymonth==4)
	{
$myconvmonth = "Apr";
	}
	elseif((int)$mymonth==5)
	{
$myconvmonth = "May";
	}
	elseif((int)$mymonth==6)
	{
$myconvmonth = "Jun";
	}
	elseif((int)$mymonth==7)
	{
$myconvmonth = "Jul";
	}
	elseif((int)$mymonth==8)
	{
$myconvmonth = "Aug";
	}
	elseif((int)$mymonth==9)
	{
$myconvmonth = "Sep";	
	}
	elseif((int)$mymonth==10)
	{
$myconvmonth = "Oct";	
	}
	elseif((int)$mymonth==11)
	{
$myconvmonth = "Nov";
	}
	elseif((int)$mymonth==12)
	{
$myconvmonth = "Dec";	
	}
	$mycompletedate = $myday .'-'.$myconvmonth . '-'. $myyear; 
	return $mycompletedate; 
	} 
} 





function loadnumberofenrollmentbymonth($regmonthvalue, $andlike) 
{ 
		$query = "Select * from monitor Where  regmonth Like '". $regmonthvalue. "' and ". $andlike;
		$datame = mysql_query($query);
		$count = 0; 
		
		if(mysql_num_rows($datame)!=0)
		{
			while($row = mysql_fetch_assoc($datame)) 
			{
			$count = $count + 1;
			}
		}
		return $count; 
}


function loadregistrationdateformatdatetoday()
{
	$myyear = date('Y'); 
	$mydate = date('d'); 
	$mymonth = date('m'); 
		
	
	$completeregdate = $myyear. $mymonth. $mydate; 
	
	return $completeregdate; 
}



function loadregistrationdatedifferential($firstregdate, $secondregdate)
{ 
$fmyyear = 0;
$fmymonth = 0;
$fmyday = 0;

$fmyyear = substr($firstregdate,0,4);
$fmymonth = substr($firstregdate,4,2);
$fmyday = substr($firstregdate,6,2);

$completestart = $fmyyear. $fmymonth . $fmyday; 

$lmyyear = 0;
$lmymonth = 0;
$lmyday = 0;

$lmyyear = substr($secondregdate,0,4);
$lmymonth = substr($secondregdate,4,2);
$lmyday = substr($secondregdate,6,2);

$completeend = $lmyyear. $lmymonth. $lmyday; 




$x = 0; 

while($completestart != $completeend) 
{
	$x = $x + 1; 
 
 	if($fmymonth==1)
	{
         if($fmyday==31)
		 { 
		  (int)$fmymonth = (int)$fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }
	}
	elseif($fmymonth==2)
	{
	     if($fmyday==28 || $fmyday==29)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }
	}
	elseif($fmymonth==3)
	{
         if($fmyday==31)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }		
	}
	elseif($fmymonth==4)
	{
         if($fmyday==30)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }	
	}
	elseif($fmymonth==5)
	{
         if($fmyday==31)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }		
	}
	elseif($fmymonth==6)
	{
          if($fmyday==30)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }		
	}
	elseif($fmymonth==7)
	{
         if($fmyday==31)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }		
	}
	elseif($fmymonth==8)
	{
         if($fmyday==31)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }
	}
	elseif($fmymonth==9)
	{
           if($fmyday==30)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }		
	}
	elseif($fmymonth==10)
	{
           if($fmyday==31)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }		
	}
	elseif($fmymonth==11)
	{
           if($fmyday==30)
		 { 
		  $fmymonth = $fmymonth + 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }		
	}
	elseif($fmymonth==12)
	{
          if($fmyday==31)
		 { 
		 $fmyyear +=1; 
		  $fmymonth = 1;
		  $fmyday =1;
		 }
		 else 
		 { 
		 $fmyday +=1; 
		 }		
	}
$completestart = $fmyyear. loadnum($fmymonth) . loadnum($fmyday); 
} 

return $x; 
}



function loadtextreturn($selecttable, $itemtoshow, $sqlstat)
{
		$query = "Select * from " .$selecttable. " ". $sqlstat ;
		$datame = mysql_query($query);
		$datereturn = ""; 
		
		if ($datame!=false )
		{
			if(mysql_num_rows($datame)!=0)
			{
				while($row = mysql_fetch_assoc($datame)) 
				{
				$datereturn = $row[$itemtoshow];
				break; 		
				}
			}
		}
		else
		{
			 	echo $query . " Error!"; 
		}	
		return $datereturn; 
}



function loadcompletetraineename($tcode)

{
	
$query = "SELECT * from trainee Where traineecode Like '" .$tcode. "'";

$mysqldata = mysql_query($query);

if($run = mysql_fetch_assoc($mysqldata))
{
	
if($run['middlename']!="")
{
	$tuldok1 = ".";
}
else 
{
	$tuldok1 ="";
}

if($run['suffix1']!="")
{
	$tuldok2 = ".";
}
else 
{
	$tuldok2 ="";
}

if($run['suffix2']!="")
{
	$tuldok3 = ".";
}
else 
{
	$tuldok3 ="";
}

	
	
$completedetails =  $run['firstname'] .' '. $run['suffix1'] . $tuldok2 .' '. $run['middleinitial'] . $tuldok1 .' '. $run['lastname'] .' '. $run['suffix2']. $tuldok3 ;
	return $completedetails;
}
else 
{ 
echo 'There is no Record Found';
} 
}

function loadcompleteagencyname($agencycode)
{
		$query = "Select * from agency Where agencycode Like '". $agencycode . "'";
		$datame = mysql_query($query);
		$agencycompletename = ""; 
		
		if(mysql_num_rows($datame)!=0)
		{
			while($row = mysql_fetch_assoc($datame)) 
			{
			$agencycompletename = $row["agencyname"];	
			}
		}
		return $agencycompletename; 
}



function loadcompleteoperatorname($operatorcode)
{
		$query = "Select * from repre Where myid Like '". $operatorcode . "'";
		$datame = mysql_query($query);
		$repname = ""; 
		
		if(mysql_num_rows($datame)!=0)
		{
			while($row = mysql_fetch_assoc($datame)) 
			{
			$repname = $row["repname"];	
			}
		}
		return $repname; 
}

function loadmilitarytoword($yourmilitarytime)
{
	
	$returnword  = ""; 
	
	if($yourmilitarytime == "06") 
	{ 
		$returnword = "6:00 AM"; 
	}
	elseif($yourmilitarytime == "07") 
	{ 
		$returnword = "7:00 AM"; 
	} 
	elseif($yourmilitarytime == "08") 
	{ 
		$returnword = "8:00 AM"; 
	}
	elseif($yourmilitarytime == "09") 
	{ 
		$returnword = "9:00 AM"; 
	}  
	elseif($yourmilitarytime == "10") 
	{ 
		$returnword = "10:00 AM"; 
	}  
	elseif($yourmilitarytime == "11") 
	{ 
		$returnword = "11:00 AM"; 
	}
	elseif($yourmilitarytime == "12") 
	{ 
		$returnword = "12:00 PM"; 
	}  
	elseif($yourmilitarytime == "13") 
	{ 
		$returnword = "1:00 PM"; 
	}  
	elseif($yourmilitarytime == "14") 
	{ 
		$returnword = "2:00 PM"; 
	} 
	elseif($yourmilitarytime == "15") 
	{ 
		$returnword = "3:00 PM"; 
	}
	elseif($yourmilitarytime == "16") 
	{ 
		$returnword = "4:00 PM"; 
	}
	elseif($yourmilitarytime == "17") 
	{ 
		$returnword = "5:00 PM"; 
	}
	elseif($yourmilitarytime == "18") 
	{ 
		$returnword = "6:00 PM"; 
	}               
	elseif($yourmilitarytime == "19") 
	{ 
		$returnword = "7:00 PM"; 
	}
	elseif($yourmilitarytime == "20") 
	{ 
		$returnword = "8:00 PM"; 
	} 
	elseif($yourmilitarytime == "21") 
	{ 
		$returnword = "9:00 PM"; 
	}
	elseif($yourmilitarytime == "22") 
	{ 
		$returnword = "10:00 PM"; 
	}   
	elseif($yourmilitarytime == "23") 
	{ 
		$returnword = "11:00 PM"; 
	} 
	elseif($yourmilitarytime == "24") 
	{ 
		$returnword = "12:00 AM"; 
	}  
	
	return $returnword;                
} 

function loadregistrationtocompletedateshorten($registrationdate) 
{
	
	if(strlen($registrationdate) >= 8)
	{
		$myyear = substr($registrationdate,0,4);
		$mymonth = substr($registrationdate,4,2);
		$myday = substr($registrationdate,6,2);
		
		
	if((int)$mymonth==1)
	{
$myconvmonth = "Jan";
	}
	elseif((int)$mymonth==2)
	{
$myconvmonth = "Feb";
	}
	elseif((int)$mymonth==3)
	{
$myconvmonth = "Mar";
	}
	elseif((int)$mymonth==4)
	{
$myconvmonth = "Apr";
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
$myconvmonth = "Aug";
	}
	elseif((int)$mymonth==9)
	{
$myconvmonth = "Sept";	
	}
	elseif((int)$mymonth==10)
	{
$myconvmonth = "Oct";	
	}
	elseif((int)$mymonth==11)
	{
$myconvmonth = "Nov";
	}
	elseif((int)$mymonth==12)
	{
$myconvmonth = "Dec";	
	}
		
		
	$mycompletedate = $myconvmonth. ' ' . $myday . ', ' . $myyear; 
	return $mycompletedate; 
	
	} 
} 


function loadcompleteusername($username)
{
		$query = "Select * from useracct Where username Like '". $username . "'";
		$datame = mysql_query($query);
		$completename = ""; 
		
		if(mysql_num_rows($datame)!=0)
		{
			while($row = mysql_fetch_assoc($datame)) 
			{
			$middlename = 	$row["middlename"]; 
			$firstname = $row["firstname"];	
			$middleinitial = substr($middlename,0,1); 
			$lastname= $row["lastname"];	

			$completename = $firstname . ' '. $middleinitial . '. ' . $lastname;
			}
		}
		return $completename; 
}


?> 
