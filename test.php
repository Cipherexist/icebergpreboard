
<?php
  
  // PHP code to get the MAC address of Server
  $MAC = exec('getmac');
    
  // Storing 'getmac' value in $MAC
  $MAC = strtok($MAC, ' ');
    
  // Updating $MAC value using strtok function, 
  // strtok is used to split the string into tokens
  // split character of strtok is defined as a space
  // because getmac returns transport name after
  // MAC address   
  echo "MAC address of Server is: $MAC";



function GetMAC(){
    ob_start();
    system('getmac');
    $Content = ob_get_contents();
    ob_clean();
    return substr($Content, strpos($Content,'\\')-20, 17);
}

echo "   CLIENT: " . GetMAC();




  ?>