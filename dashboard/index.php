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

        <section class="content">
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <?php
										$get_users_query = "SELECT * FROM `users` WHERE 1";
										$fire_get_users = mysqli_query($connection, $get_users_query);
										while ($users = mysqli_fetch_array($fire_get_users)) {
											$number_of_users = mysqli_num_rows($fire_get_users);
										}
										echo '<h3>'.$number_of_users.'</h3>';
									?>

                  <p>Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person"></i>
                </div>
                <a href="users_list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-green">
                <div class="inner">
									<?php
										$get_music_query = "SELECT * FROM `music list` WHERE 1";
										$fire_get_music = mysqli_query($connection, $get_music_query);
										while ($music = mysqli_fetch_array($fire_get_music)) {
											$number_of_music = mysqli_num_rows($fire_get_music);
										}
										echo '<h3>'.$number_of_music.'</h3>';
									?>

                  <p>Music</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-musical-notes"></i>
                </div>
                <a href="music_list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
									<?php
										$get_mood_query = "SELECT * FROM `moods` WHERE 1";
										$fire_get_mood = mysqli_query($connection, $get_mood_query);
										while ($mood = mysqli_fetch_array($fire_get_mood)) {
											$number_of_moods = mysqli_num_rows($fire_get_mood);
										}
										echo '<h3>'.$number_of_moods.'</h3>';
									?>

                  <p>Moods</p>
                </div>
                <div class="icon">
                  <i class="ion ion-radio-waves"></i>
                </div>
                <a href="moods_list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
									<?php
										$get_friends_query = "SELECT * FROM `friends` WHERE 1";
										$fire_get_friends = mysqli_query($connection, $get_friends_query);
										while ($friend = mysqli_fetch_array($fire_get_friends)) {
											$number_of_friends = mysqli_num_rows($fire_get_friends);
										}
										echo '<h3>'.$number_of_friends.'</h3>';
									?>

                  <p>Friendships</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-people"></i>
                </div>
                <a href="friends_list.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
        </section>
				<section class="content">
					<div class="col-md-8">
						<table class="table table-hover">
							<tr class="success active">
								<th>User ID</th>
								<th>User Full Name</th>
								<th>User Name</th>
								<th>User Email</th>
							</tr>
							<?php
								$get_users_query = "SELECT * FROM `users` WHERE 1";
								$get_users_query.=" ORDER BY id ASC LIMIT 25";
								$fire_get_users = mysqli_query($connection, $get_users_query);
								while ($users = mysqli_fetch_array($fire_get_users)) {
									$person_id = $users['id'];
									$person_fullname = $users['full name'];
									$person_username = $users['username'];
									$person_email = $users['email'];

									echo '<tr>
													<td>'.$person_id.'</td>
													<td>'.$person_fullname.'</td>
													<td>'.$person_username.'</td>
													<td>'.$person_email.'</td>
												</tr>';
								}
							 ?>
						</table>
					</div>
					<div class="col-md-4">
						<div class="list-group">
							<a href="#" class="list-group-item active">
								Latest Music List
							</a>
							<?php
									$get_latest_music = "SELECT * FROM `music list` WHERE 1";
									$get_latest_music.=" ORDER BY id DESC LIMIT 10";
									$fire_get_latest_music = mysqli_query($connection, $get_latest_music);

									while ($rows = mysqli_fetch_array($fire_get_latest_music)) {
										$music_id = $rows['id'];
										$music_pic = $rows['picture'];
										$music_name = $rows['name'];
										$music_artist = $rows['artist'];
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
							?>
						</div>
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
