<?php 
include 'loadfunction.php'; 
include 'modules.php'; 



@$myanswer = $_POST['choiceanswer'];
@$mynumber = $_POST['choicenumber']; 
@$mycode = $_POST['choicecode']; 
@$username = $_COOKIE['usname']; 


// echo $myanswer. ' ' . $mynewnumber . ' ' . $mycode; 
$mysession = loadmysession($_COOKIE['usname'],$mycode); 

include 'dbcon.php'; 

$mysqlme = "SELECT * from onlineresults Where qno Like '$mynumber' and username Like '$username' and course Like '$mycode'"; 
$dba = mysqli_query($sqlcon, $mysqlme); 

if(!mysqli_error($sqlcon))
{
    if(mysqli_num_rows($dba)!=0)
    {

        while($rows = mysqli_fetch_assoc($dba))
        {
            @$id = $rows['ID']; 
            $mystatus = ""; 
            if($myanswer==$rows['answer'])
            {
                $mystatus = "PASSED"; 
            }
            else 
            {
                $mystatus = "FAILED"; 
            }
            include 'dbcon.php'; 
            $mysqli = "UPDATE onlineresults SET `uranswer`='$myanswer', `status`='$mystatus' Where ID Like '$id'"; 
            $dbx = mysqli_query($sqlcon, $mysqli); 

            if(!mysqli_error($sqlcon))
            {
                echo loadmyquestion($mynumber,$mycode,$mysession);
            }
            else 
            {
                include 'forcookie.php'; 
            }

        }
    }
    else 
    {
        echo $mysqlme ;
       
    }

}
else 
{

}








?> 
