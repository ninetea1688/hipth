<?php
 $host = "localhost" ;
  $user = "root" ;
  $pass = "212224" ;
  $db = "hi" ;
  global $conn;
  $conn = mysqli_connect($host,$user,$pass) or die(mysql_error());
  mysqli_query($conn,"SET character_set_results=utf8");
  mysqli_query($conn,"SET character_set_client=utf8");
  mysqli_query($conn,"SET character_set_connection=utf8");
  mysqli_select_db($conn,$db) ; 
 ?>