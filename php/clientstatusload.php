<?php 
require 'dbcon.php';
require 'default.php';
include 'php/loadmodules.php'; 



$mymonth = $_POST['mdate'];
$myyear = $_POST['ydate'];


echo '<div class="row" id="backcolorstyle" style="margin-top:10px;"> 

<table class="table">
	<thead>
    <tr>
      <th colspan="4">Newly Client For This Month</th>
    </tr>
	</thead> 
	';

$query = "SELECT * FROM `agency` ORDER BY dateins ASC";
$datame = mysql_query($query);
if(mysql_num_rows($datame)!=0)
{
	$counting = 0;
	while($row = mysql_fetch_assoc($datame))
	{
	$dateinsme= $row["dateins"]; 

	$extractyear = substr($dateinsme ,0,4); 
	$extractmonth = substr($dateinsme ,4,2);

		if ($extractyear == $myyear && $extractmonth == $mymonth)
		{
				$counting =$counting + 1;	
				echo '
  				<tbody>
    			<tr>
				<td class="tdbs" style="color:#000;">'. $counting .'</td>
      			<td class="tdbs" style="color:#000;">'. $row["agencyname"] .'</td>
      			<td class="tdbs" style="color:#000;">'. loadregistrationtocompletedate($row["dateins"]) .'</td>
				<td class="tdbs" style="color:#000;">'. $row["marketingby"] .'</td>
    			</tr>
  				</tbody>';
		}
	}

} 

echo '</table> </div>'; 




echo '<div class="row" id="backcolorstyle" style="margin-top:10px;"> 

<table class="table">
	<thead>
    <tr>
      <th colspan="4">Approved Client For This Month</th>
    </tr>
	</thead> 
	';

$query = "SELECT * FROM `agency` ORDER BY contractsigned ASC";
$datame = mysql_query($query);
if(mysql_num_rows($datame)!=0)
{
	while($row = mysql_fetch_assoc($datame))
	{
	$dateinsme= $row["contractsigned"]; 

	$extractyear = substr($dateinsme ,0,4); 
	$extractmonth = substr($dateinsme ,4,2);

		if ($extractyear == $myyear && $extractmonth == $mymonth)
		{
				$counting = $counting + 1;	
				echo '
  				<tbody>
    			<tr>
				<td class="tdbs" style="color:#000;">'. $counting .'</td>
      			<td class="tdbs" style="color:#000;">'. $row["agencyname"] .'</td>
      			<td class="tdbs" style="color:#000;">'. loadregistrationtocompletedate($row["contractsigned"]) .'</td>
				<td class="tdbs" style="color:#000;">'. $row["marketingby"] .'</td>
    			</tr>
  				</tbody>';
		}
	}

} 

echo '</table> </div>'; 




echo '<div class="row" id="backcolorstyle" style="margin-top:10px;">'; 

echo '<table class="table">
	<thead>
    <tr>
      <th colspan="4">Client Status</th>
    </tr>
	</thead> 
	 <tbody>
	';

	echo '
  	<tr>
	<td class="tdbs" style="color:#000;">Client Name</td>
    <td class="tdbs" style="color:#000;">Sended Last Date</td>
    <td class="tdbs" style="color:#000;">Days Gap</td>
	<td class="tdbs" style="color:#000;">Status</td>
    </tr>';
	
$query = "SELECT * FROM `agency` ORDER BY agencyname ASC";
$datame = mysql_query($query);
if(mysql_num_rows($datame)!=0)
{
	while($row = mysql_fetch_assoc($datame))
	{
			$lastdaysend = ""; 
			$lastdaysend = loadtextreturn("monitor", "regdate", "Where manning Like '". $row["agencycode"] ."' ORDER BY regdate DESC"); 
			$todayformat = ""; 
			$todayformat = loadregistrationdateformatdatetoday(); 
			
			$mydaystogo = ""; 
			if((int)substr($lastdaysend,0,4) == date('Y'))
			{ 
				if(loadregistrationdatedifferential($lastdaysend, $todayformat) ==0)
				{
				$mydaystogo = "Up To Date";
				}
				else 
				{
				$mydaystogo = loadregistrationdatedifferential($lastdaysend, $todayformat). " Day(s)"; 
				}

			
			}
			else 
			{
			$mydaystogo = "Not Active";
			}
			
			
			if($mydaystogo == "Not Active")
			{
			echo '<tr style="background-color:AA6539;">';
			}
			else 
			{ 
			echo '<tr>';
			}
			echo '
			<td class="tdbs" style="color:#000;">'. $row["agencyname"] .'</td>
    		<td class="tdbs" style="color:#000;">'. loadregistrationtocompletedate($lastdaysend) . '</td>
      		<td class="tdbs" style="color:#000;">'. $mydaystogo. '</td>
			<td class="tdbs" style="color:#000;">'. $row["status"] .'</td>
    		</tr>';
		
	}

} 	


echo '</tbody> </table>'; 



echo '</div>'; 







?> 
