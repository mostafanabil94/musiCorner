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
              if(isset($_GET['profile_id'])){
                $profile_id = $_GET['profile_id'];

                $get_profile = "SELECT * FROM `users` WHERE `id`='$profile_id'";
                $fire_get_profile = mysqli_query($connection, $get_profile);

                if($fire_get_profile){
                  while ($rows = mysqli_fetch_array($fire_get_profile)) {
                    $profile_username = $rows['username'];
  									$profile_fullname = $rows['full name'];
                    $profile_email = $rows['email'];
                    $profile_picture = "../".$rows['profile picture'];
                    $profile_role = $rows['role'];
                    echo '<div class="col-md1">
                          </div>
                          <div class="col-md-10">
                            <div class="panel panel-primary">
                              <div class="panel-heading">
                                <h3 class="panel-title">'.$profile_fullname.'</h3>
                              </div>
                              <div class="panel-body">
                                <a href="#" class="thumbnail">
                                  <img src="'.$profile_picture.'" alt="..." width="250px" height="250px">
                                </a>
                                <strong>Username: </strong>'.$profile_username.'<br>
                                <strong>Email: </strong>'.$profile_email.'<br>
                                <strong>Role: </strong>'.$profile_role.'<br>
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
