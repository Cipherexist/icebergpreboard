<?php 
include 'loadfunction2.php'; 
include 'modules.php'; 



@$myanswer = $_POST['choiceanswer'];
@$mynumber = $_POST['choicenumber']; 
@$mycode = $_POST['choicecode']; 
@$mycompetence = $_POST['choicecompetence']; 
@$username = $_COOKIE['usname']; 


// echo $myanswer. ' ' . $mynewnumber . ' ' . $mycode; 
@$mysession = loadmysession($_COOKIE['usname'],$mycode); 
$mynumber = $mynumber - 1;
include 'dbconfig.php'; 

$mysqlme = "SELECT * from onlineresults Where qno Like '$mynumber' and session Like '$mysession' and username Like '$username' and course Like '$mycode' and competence Like '$mycompetence'"; 
$dba = mysqli_query($con, $mysqlme); 


if(!mysqli_error($con))
{
    if(mysqli_num_rows($dba)!=0)
    {

        while($rows = mysqli_fetch_assoc($dba))
        {
         
            
                echo loadmyquestion($mynumber,$mycode,$mysession,$mycompetence);
            
          //  echo $mysqlme; 
        //  echo loadmyquestion($mynumber,$mycode,$mysession,$mycompetence);

        }
    }
    else 
    {
        echo $mysqlme ;
       
    }

}
else 
{
echo mysqli_error($con);
}








?> 
