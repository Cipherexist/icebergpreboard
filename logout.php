<?php
               
$huan = "0";
$two = "0";
setcookie('usname', $huan, time() - 3600);
setcookie('psword', $two, time() - 3600);
setcookie('accesstype', "0", time() - 3600);


echo '<script> window.location.replace("login.php");</script> ';


?> 
