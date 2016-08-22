<?php session_start();
	include 'includes/connection.php';
	if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['password']) == true && isset($_GET['profile_id']) == true){

		$user_id	= $_SESSION['id'];
		$email 		= $_SESSION['email'];
		$password = $_SESSION['password'];

		$profile_id = $_GET['profile_id'];
		$profile_query = "SELECT * FROM `users` WHERE `id` = '$profile_id'";

		$result = mysqli_query($connection, $profile_query);

			while($rows = mysqli_fetch_array($result)){
				if(mysqli_num_rows($result) == 1 ){

					$fullname = $rows['full name'];
					$profile_username = $rows['username'];
					$profile_pic = $rows['profile picture'];
				}
			}
	} else {
		header('Location: home.php');
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title><?php echo "$fullname" ?></title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>

<body id="profile">
	<?php include "includes/header.php" ?>

	<div class="container card cf">
		<?php echo '<div class="main-photo" style="background-image: url('.$profile_pic.');"></div>' ?>
		<p class="full-name"><?php echo "$fullname" ?></p>

		<?php
				if ($user_id == $profile_id) {
					echo '<a class="edit" href="profile_edit.php?profile_id='.$profile_id.'"><i class="fa fa-pencil" aria-hidden="true"></i>EDIT INFO</a>';
				} else {
					$is_friend = "SELECT * FROM `friends` WHERE `friend1_id` = '$user_id' AND `friend2_id` = '$profile_id'";
					$fire_is_friend = mysqli_query($connection, $is_friend);

					if($fire_is_friend){
						if(mysqli_num_rows($fire_is_friend) != 0){
							echo '<a name="unfollow" class="follow" href="includes/unfollow.php?unfollow_id='.$profile_id.'">
										<i class="fa fa-user-times" aria-hidden="true"></i>UNFOLLOW</a>';
						} else {
							echo '<a name="follow" class="follow" href="includes/follow.php?follow_id='.$profile_id.'">
										<i class="fa fa-user-plus" aria-hidden="true"></i>FOLLOW</a>';
					}
				}
			}
	  ?>

		<div class="song-list">
			<h1>recommends these songs</h1>
			<?php
				$fetch_moods = "SELECT * FROM `moods` WHERE 1";
				$fire_fetch_moods = mysqli_query($connection, $fetch_moods);

				if($fire_fetch_moods){
					while ($rows = mysqli_fetch_array($fire_fetch_moods)) {
						$current_mood_id = $rows['id'];
						$current_mood_name = $rows['name'];

						$fetch_music = "SELECT * FROM `music list` WHERE `mood` = '$current_mood_id' AND `added by` = '$profile_id'";
						$fire_fetch_music = mysqli_query($connection, $fetch_music);

						if($fire_fetch_music){
							echo '<p class="mood">'.$current_mood_name.'</p>
										<hr/>';
							while ($music = mysqli_fetch_array($fire_fetch_music)) {
								$music_name = $music['name'];
								$music_artist = $music['artist'];
								$music_picture = $music['picture'];
								$music_youtube_link = $music['youtube link'];
								echo '<div class="song card">
												<div class="pic" style="background-image: url('.$music_picture.');"></div>
												<p class="name">'.$music_name.'</p>
												<p class="info">by <span>'.$music_artist.'</span></p>
												<a href="'.$music_youtube_link.'" target="_blank" class="yt-link"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
											</div>';
							}
						}
					}
				}
			?>
		</div>

	</div>

	<script src="js/jquery.js"></script>
	<script src="js/header.js"></script>
</body>

</html>
