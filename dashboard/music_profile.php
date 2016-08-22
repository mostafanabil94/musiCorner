<?php session_start();
	include '../includes/connection.php';
	if(isset($_SESSION['email']) && isset($_SESSION['password']) == true){

		$current_email = $_SESSION['email'];
		$homepage_query = "SELECT * FROM `users` WHERE `email` = '$current_email'";

		$result = mysqli_query($connection, $homepage_query);

			while($rows = mysqli_fetch_array($result)){
				if(mysqli_num_rows($result) == 1 ){
					$user_id = $rows['id'];
					$email = $rows['email'];
					$password = $rows['password'];
					$fullname = $rows['full name'];
					$username = $rows['username'];
					$profile_pic = $rows['profile picture'];
				}
			}
	} else {
		header('Location: home.php');
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MusiCorner | Dashboard</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
			<?php include "includes/header.php" ?>
			<?php include "includes/sidebar.php" ?>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            MusiCorneR | DashBoard
          </h1>
        </section>

				<section class="clearfix content">
					<?php
              if(isset($_GET['music_id'])){
                $music_id = $_GET['music_id'];

                $get_music = "SELECT * FROM `music list` WHERE `id`='$music_id'";
                $fire_get_music = mysqli_query($connection, $get_music);

                if($fire_get_music){
                  while ($rows = mysqli_fetch_array($fire_get_music)) {
                    $music_name = $rows['name'];
  									$music_artist = $rows['artist'];
                    $music_link = $rows['youtube link'];
                    $music_picture = "../".$rows['picture'];
                    $music_addedby = $rows['added by'];
                    if($music_addedby != ''){
                      $added_by_query = "SELECT * FROM `users` WHERE `id` = '$music_addedby'";
                      $result = mysqli_query($connection, $added_by_query);
                			while($rows = mysqli_fetch_array($result)){
                          $music_addedby = $rows['username'];
                      }
                    }
                    echo '<div class="col-md-1">
                          </div>
                          <div class="col-md-10">
                            <div class="panel panel-primary">
                              <div class="panel-heading">
                                <h3 class="panel-title">'.$music_name.'</h3>
                              </div>
                              <div class="panel-body">
																<div class="col-md-6">
																	<img src="'.$music_picture.'" alt="..." width="350px" height="350px">
																</div>
																<div class="col-md-6">
																	<br><br><br>
																	<strong>Song: </strong> '.$music_name.'<br><br><br>
																	<strong>By: </strong> '.$music_artist.'<br><br><br>
																	<strong>Youtube Link: </strong><a href="'.$music_link.'">Link</a><br><br><br>
																	<strong>Added By: </strong>'.$music_addedby.'<br><br><br>
						                    </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-1">
                          </div>';
                  }
                }
              }
          ?>
				</section>
      </div>

      <?php echo include 'includes/footer.php'; ?>
			<?php echo include 'includes/sidebar-control.php'; ?>

    </div>

  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/js/app.min.js"></script>

  </body>
</html>
