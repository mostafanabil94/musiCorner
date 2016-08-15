<?php
  $host = "localhost";
  $name = "root";
  $password = "";
  $dbname = "musicorner";

  $connection = mysqli_connect($host, $name, $password, $dbname);

  if (!$connection) {
  	die("Failed To Connect To DB!!!");
  }
?>
