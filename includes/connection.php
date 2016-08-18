<?php
  $host = "127.0.0.1:3307";
  $name = "root";
  $password = "";
  $dbname = "musicorner";

  $connection = mysqli_connect($host, $name, $password, $dbname);

  if (!$connection) {
  	die("Failed To Connect To DB!!!");
  }
?>
