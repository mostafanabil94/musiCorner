<?php
  session_start();
  include 'connection.php';
  if(isset($_SESSION['email']) && isset($_SESSION['password']) == true){

    $email 	= $_SESSION['email'];
    $homepage_query = "SELECT * FROM `users` WHERE `email` = '$email'";

    $result = mysqli_query($connection, $homepage_query);

      while($rows = mysqli_fetch_array($result)){
        if(mysqli_num_rows($result) == 1 ){
          $user_id = $rows['id'];
        }
      }
  } else {
    header('Location: ../home.php');
  }
  if(isset($_GET['follow_id'])){
    $follow_id = $_GET['follow_id'];

    $follow_user = "INSERT INTO `friends`
                    (`friend1_id`, `friend2_id`)
                    VALUES
                    ('$user_id', '$follow_id')";
    $fire_follow_user = mysqli_query($connection, $follow_user);

    echo '<script> alert("You have followed this user!")</script>';
  }
  header('Location: ../home.php');
 ?>
