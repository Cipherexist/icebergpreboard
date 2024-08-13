<?php 
require 'dbconfig.php';


function setcookiecompetence($competence)
{
   	$setlimit = 10000;
        setcookie('competence', $competence, time()+$setlimit);
    
    
    return $_COOKIE['competence'];
    
}


function loadcheckifexamexist($sessionme, $viewtype, $competence, $username)
{
		include 'dbconfig.php'; 

		$query1 = "Select * from `results` Where viewtype Like '". $viewtype. "' and session Like '". $sessionme . "' and competence Like '". $competence. "' and username Like '". $username . "'";
		$query2 = "DELETE FROM `results` Where viewtype Like '". $viewtype. "' and session Like '". $sessionme . "' and competence Like '" . $competence. "' and username Like '". $username . "'";
		
		
		$datamex = mysqli_query($con,$query1);
		if(mysqli_num_rows($datamex)!=0)
		{
			
			if(mysqli_query($con,$query2))
			{
			}
			else
			{
				 echo mysqli_error($con) ;
			}
			
		}
}



function loadcompetencetitle($viewtype, $competence)
{
	include 'dbconfig.php'; 
		$query = "Select * from `competence` Where viewtype Like '". $viewtype. "' and competence Like '". $competence . "'";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$codecomplete = $row["STATUS"]; 
 			}
		}
		
	    return $codecomplete;
}

function loadcheckedifpassed($viewtype, $competence , $question , $username)
{
        $codecomplete = "FAILED"; 
        
		include 'dbconfig.php'; 
		$query = "Select * from `results` Where viewtype Like '". $viewtype. "' and competence Like '". $competence .  "' and question Like '". $question .  "' and username Like '". $username . "'";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$codecomplete = $row["status"]; 
 			}
		}
		
	    return $codecomplete;
}

function loadmytotalaverage($username)
{
	include 'dbconfig.php'; 
		$query = "Select * from `sessiontime` Where username Like '". $username. "'";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
		    $averagecount = 0;
		    $averageadd = 0;
			while($row = mysqli_fetch_assoc($datame)) 
			{
			    if($row["AVERAGE"]!="")
			    {
			        $averagecount = $averagecount + 1; 
			        $averageadd = $averageadd + $row["AVERAGE"]; 
			    }
 			}
 			$mytotalaverage = $averageadd / $averagecount; 
 			$rounded = round($mytotalaverage);
 			
 			$fetchqry2 = "UPDATE `user_data` SET `average`='". $rounded . "',`items`='". $averagecount . "' WHERE username Like '". $username . "'"; 
             if(mysqli_query($con,$fetchqry2))
              { 
    
              }
             else
                {
                  echo mysqli_error($con) ;
                 echo "ERRORS" ;
               }
 		
 			
 			
		}
		
	    return $rounded;
}

function loadcompetencepercent($viewtype, $competence)
{
	include 'dbconfig.php'; 
		$query = "Select * from `competence` Where viewtype Like '". $viewtype. "' and competence Like '". $competence . "'";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$codecomplete = $row["PERCENTAGE"]; 
 			}
		}
		
	    return $codecomplete;
}

function loadsessiontime($username)
{
	include 'dbconfig.php'; 
		$query = "Select * from `sessiontime` Where username Like '". $username . "' ORDER BY ID ASC";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$codecomplete = $row["DATEANDTIME"]; 
 			}
		}
		else 
		{
		    	$codecomplete = mysqli_error($con);
		}
		
	    return $codecomplete;
}



function loadcompetencename($viewtype, $competence)
{
		include 'dbconfig.php';
		$query = "Select * from `competence` Where viewtype Like '". $viewtype. "' and competence Like '". $competence . "'";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$codecomplete = $row["STATUS"]; 
 			}
		}
		else
		{
			$codecomplete = $query; 
		}
		
	    return $codecomplete;
}

function loadcompetencealive($username)
{
		include 'dbconfig.php';
		$query = "Select * from `user_data` Where username Like '". $username. "'";
		$datame = mysqli_query($con, $query);
		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
			$codecomplete = $row["competence"]; 
 			}
		}
		else
		{
			$codecomplete = $query; 
		}
		
	    return $codecomplete;
}



function loadlastresult($viewtype, $competence, $username, $questionname)
{
		include 'dbconfig.php';
		$query = "Select * from `results` Where viewtype Like '". $viewtype. "' and competence Like '". $competence . "' and username like '". $username . "' and question Like '".$questionname ."' ORDER BY ID DESC";
		$datame = mysqli_query($con, $query);
		$x = 0 ;

		if(mysqli_num_rows($datame)!=0)
		{
			while($row = mysqli_fetch_assoc($datame)) 
			{
				$x +=1; 
				if($x==1)
				{
					$codecomplete = $row['status']; 
				}
			
 			}
		}
		else
		{
			$codecomplete = "None";
		}
		
	    return $codecomplete;
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
	include 'dbconfig.php'; 
		$query = "Select * from `" .$selecttable. "` ". $sqlstat . " ORDER BY ID DESC" ;
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














?> 
