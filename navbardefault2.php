  <?php 
function loaduseraccesstype($username)
{
    $daf = mysqli_connect('localhost','invictus_user','N@vigator00000','invictus_review');
    $query = "Select * from `invictus_review`.`user_data` Where username Like '". $username. "'";
    $datame = mysqli_query($daf, $query);
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

  <body role="document">
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand"><?php echo $_COOKIE['completename']; ?></a>
        </div>
        <div class="navbar-collapse collapse" class="myNavbar">
          <ul class="nav navbar-nav" class="list-inline">
            <?php 
            if(loaduseraccesstype($_COOKIE['usname'])=='Admin')
            {
              echo "<li class='cli'><a href='preboard.php'>Home</a></li>";
			  
			 echo '<li class="dropdown">';
        echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">Registration<span class="caret"></span></a>';
             echo '<ul class="dropdown-menu">';
		  
               echo "<li class='cli'><a href='registeruser.php'>Register Online User</a></li>";
			   echo "<li class='cli'><a href='registeruserapp.php'>Register App User</a></li>";
			    
			echo	'</ul></li>';
				
				echo "<li class='cli'><a href='accessability.php'>Android Accounts</a></li>";
				echo "<li class='cli'><a href='preboardaccounts.php'>Preboard Accounts</a></li>";
					echo "<li class='cli'><a href='monitoring.php'>Monitoring</a></li>";
					echo "<li class='cli'><a href='rankings.php'>TOP Scores</a></li>";
               echo "<li class='cli'><a href='logout.php'>LOGOUT</a></li>";
            }
            else
            {
              echo "<li class='cli'><a href='preboard.php'>Home</a></li>";
              echo "<li class='cli'><a href='preboard.php'>Preboard and Review</a></li>";
            //  echo "<li class='cli'><a href='mypendings.php'>Check Pendings</a></li>";
             // 	echo "<li class='cli'><a href='scores.php'>Your Sessions</a></li>";
             // 	echo "<li class='cli'><a href='rankings.php'>TOP Scores</a></li>";
               echo "<li class='cli'><a href='logout.php'>";

               
              echo "LOGOUT</a></li>";
            }
          
            ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>