    	<table class="table table-striped table-bordered mydatatable" style="width: 100%"> 
    	
    	<thead>
        <tr>
        <th> No </th>
        <th> Registered User </th>
        <th> Activation Code </th>
  	    <th> Viewtype </th>
        <th> Valid </th>
          <th> Date Created </th>
			 <th> App registered </th>
			   <th> LastLogin </th>
			    <th> Access </th>
			 	 <th> FUNCTION </th>
        </tr>
        </thead>
        
        <tbody>
      <?php 
  include 'dbconfig.php'; 

  $fetchqry  = "SELECT * FROM `invictus_review`.`examapproved` Where hide Like 'yes' and controlstatus like '100'"; 
  $datame1 = mysqli_query($con,$fetchqry);
  $numrows=mysqli_num_rows($datame1);
  $x = 0; 
  $proceedend = 0; 


  if($numrows!=0)
  {
    while($row = mysqli_fetch_assoc($datame1))
    {
      //  setcookie('username', $row["username"], time()+$setlimit);
      //  setcookie('viewtype', $row["viewtype"], time()+$setlimit);
//setcookie('completename', $row["completename"], time()+$setlimit);
   $x = $x +1; 
   if($row["status"]=='yes')
   {
	   echo "<tr style='background-color:LIGHTGREEN;'>"; 
   }else
   {
	   echo "<tr style='background-color:YELLOWORANGE;'>"; 
   }
  	echo "<td> ". $x . "</td>"; 
	echo "<td> ". $row["usernameusage"] . "</td>"; 
	echo "<td> ". $row["password"] . "</td>"; 
	echo "<td> ". $row["viewtype"] . "</td>"; 
    echo "<td> ". $row["status"] . "</td>"; 
		echo "<td> ". $row["datecreated"] . "</td>"; 
	echo "<td> ". $row["dateactivated"] . "</td>";
		echo "<td> ". lastlogin($row["usernameusage"])  . "</td>"; 
	$myusername = "'". $row["usernameusage"] . "'"; 
		echo "<td> ". $row["controlstatus"] . "</td>";
	echo '<td> <input type="button" id="driver" value="Deactivate" class="button" onClick="deleteme('. $myusername. ');"/>' . '</td>';
	echo "</tr>"; 
	}
	
  }
	
      ?> 

    

</tbody>


    </table>
