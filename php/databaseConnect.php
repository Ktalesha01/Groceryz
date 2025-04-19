<?php
  $db_hostname = "localhost";
  $db_username = "root";
  $db_password = "";
  $db_name = "groceryz";

  $conn = MYSQLI_CONNECT( $db_hostname , $db_username , $db_password , $db_name );
  if(!$conn){
    die();
  }
?>