<?php 
include 'dbconfig.php'; 
include 'modules.php'; 


@$viewtype = $_POST['ssviewtype']; 
@$username = $_POST['ssusername']; 
@$mysession = 0; 


$SQLME = "Select * from examapproved Where email Like '$username' and viewtype Like '$viewtype'"; 


$dbt = mysqli_query($con,$SQLME); 


if (!mysqli_error($con))
{
    if(mysqli_num_rows($dbt)!=0)
    {
        while($rows = mysqli_fetch_assoc($dbt))
        {   
            
            if($rows['session']=="")
            {
                $mysession = 1; 
            }
            else 
            {
                $mysession = $rows['session'];
            }
        }

        if ($mysession>0)
        {
            $mysession +=1;

            $myssql = "UPDATE examapproved SET `session`='$mysession' Where email Like '$username' and viewtype Like '$viewtype'";
            mysqli_query($con,$myssql); 
            
            if(!mysqli_error($con))
            {
                    echo 1; 
            }
            else 
            {
                echo "Error in updating " . mysqli_error($con); 
            }

        }

    }
} 
else 
{
    echo "Error in Loading " . mysqli_error($con); 
}







//echo $viewtype . ' ' . $username ;



?> 

