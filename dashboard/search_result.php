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
					<div class="col-md-10">
						<?php
              $search_value = '';
              if(isset($_GET['search'])){
                $search_value = $_GET['search'];
								echo '<h1><i class="fa fa-search"></i> Search results for '.$search_value.'</h1>';

                $search_by_music = "SELECT * FROM `music list` WHERE `name` LIKE '%$search_value%' OR `artist` LIKE '%$search_value%'";
                $fire_search_by_music = mysqli_query($connection, $search_by_music);

                if($fire_search_by_music){
									echo '<h1>Music</h1><br>';
									while ($music = mysqli_fetch_array($fire_search_by_music)) {
										$music_id = $music['id'];
										$music_name = $music['name'];
										$music_artist = $music['artist'];
										$music_pic = $music['picture'];
										echo '<a href="music_profile.php?music_id='.$music_id.'" class="list-group-item">
														<div class="col-sm-4">
															<img src="../'.$music_pic.'" alt="...." class="img-responsive">
														 </div>
														 <div class="col-sm-8">
															<h4 class="list-group-item-heading">'.$music_name.'</h4>
															<p class="list-group-item-text">By '.$music_artist.'</p>
														 </div>
														 <div class="clearfix"></div>
													</a>';
									}
									echo '<br><br>';
                }
							}
	              $search_value = '';
	              if(isset($_GET['search'])){
	                $search_value = $_GET['search'];

	                $search_by_users = "SELECT * FROM `users` WHERE `username` LIKE '%$search_value%'
																			OR `full name` LIKE '%$search_value%' OR `email` LIKE '%$search_value%'";
	                $fire_search_by_users = mysqli_query($connection, $search_by_users);

	                if($fire_search_by_users){
										echo '<h1>Users</h1><br>';
										while ($user = mysqli_fetch_array($fire_search_by_users)) {
											$users_id = $user['id'];
											$user_username = $user['username'];
											$user_fullname = $user['full name'];
											$user_email = $user['email'];
											$user_pic = $user['profile picture'];
											echo '<a href="user_profile.php?profile_id='.$users_id.'" class="list-group-item">
															<div class="col-sm-4">
																<img src="../'.$user_pic.'" alt="...." class="img-responsive">
															 </div>
															 <div class="col-sm-8">
																<h4 class="list-group-item-heading">'.$user_username.'</h4>
																<p class="list-group-item-text">By '.$user_fullname.'</p>
																<p class="list-group-item-text">By '.$user_email.'</p>
															 </div>
															 <div class="clearfix"></div>
														</a>';
										}
										echo '<br><br>';
	                }
								}
            ?>
					</div>
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
