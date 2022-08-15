<?php

    $host = "127.0.0.1";
    $username ="root";
    $password = "";
    $database = "onlympics";

   $conn = mysqli_connect($host, $username,$password,$database);
    
   if(!$conn){
       echo "Connection to Database failed";
   }
?>