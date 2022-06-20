<?php
  $hostname = "localhost";
  $user = "root";
  $pass = "";
  $dbname = "chatapp";

  $conn = mysqli_connect($hostname, $user, $pass, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
