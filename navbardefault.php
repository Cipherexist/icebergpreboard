  <?php 
function loaduseraccesstype($username)
{
    include 'dbconfig.php';
    $query = "Select * from `user_data` Where username Like '". $username. "'";
    $datame = mysqli_query($con, $query);
    if(mysqli_num_rows($datame)!=0)
    {
      while($row = mysqli_fetch_assoc($datame)) 
      {
      $codecomplete = $row["accesstype"]; 
      }
    }
    else
    {
      $codecomplete = $query; 
    }
    
      return $codecomplete;
}



  ?>
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Hi <?php echo $_COOKIE['usname']; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      
      
      
      <?php
            if(loaduseraccesstype($_COOKIE['usname'])=='Admin')
            {
      echo   '<li class="nav-item active">
             <a class="nav-link" href="registeruser.php">Home <span class="sr-only">(current)</span></a>
              </li>';
        
      echo  '       <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Registration
                </a>
               <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
               <a class="dropdown-item" href="registeruser.php">Online User</a>
               <a class="dropdown-item" href="registeruserapp.php">App User</a>
              </div>
            </li> ';
      
      echo ' <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Manage Accounts
             </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
               <a class="dropdown-item" href="accessability2.php">Android Accounts</a>
                 <a class="dropdown-item" href="preboardaccounts2.php">Preboard Accounts</a>
               </div>
           </li> ';
      
      
      echo '       <li class="nav-item">
              <a class="nav-link" href="monitoring.php">Monitoring</a>
           </li> ';
      
      echo '        <li class="nav-item">
                <a class="nav-link" href="rankings.php">TOP Scores</a>
              </li>';
              
      echo '        <li class="nav-item">
                <a class="nav-link" href="logout.php">logout</a>
              </li>';              
              
              
            }
            
            else 
            {
      echo '<li class="nav-item active"><a class="nav-link" href="preboard.php">Home <span class="sr-only">(current)</span></a></li>';      
      echo '<li class="nav-item"><a class="nav-link" href="preboard.php">Preboard and Review</a></li> ';
    //  echo '<li class="nav-item"><a class="nav-link" href="mypendings.php">Check Pendings</a></li> ';
     //  echo '<li class="nav-item"><a class="nav-link" href="scores.php">Your Sessionss</a></li> ';
      // echo '<li class="nav-item"><a class="nav-link" href="rankings.php">TOP Scores</a></li>';
       echo '<li class="nav-item"><a class="nav-link" href="logout.php">logout</a></li>';              
                              
                
            }
      
      ?>
    </ul>
  </div>
</nav>