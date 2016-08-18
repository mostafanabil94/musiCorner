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
  if(isset($_GET['unfollow_id'])){
    $unfollow_id = $_GET['unfollow_id'];

    $unfollow_user = "DELETE FROM `friends` WHERE `friend1_id` = '$user_id' AND `friend2_id` = '$unfollow_id'";
    $fire_unfollow_user = mysqli_query($connection, $unfollow_user);

    echo '<script> alert("You have unfollowed this user. He must have been annoying :P")</script>';
  }
  header('Location: ../home.php');
 ?>
