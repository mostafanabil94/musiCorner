<?php session_start();
	include 'includes/connection.php';
	if(isset($_SESSION['email']) && isset($_SESSION['password']) == true){

		$email 	= $_SESSION['email'];
		$homepage_query = "SELECT * FROM `users` WHERE `email` = '$email'";

		$result = mysqli_query($connection, $homepage_query);

			while($rows = mysqli_fetch_array($result)){
				if(mysqli_num_rows($result) == 1 ){
					$user_id = $rows['id'];
					$password = $rows['password'];
					$fullname = $rows['full name'];
					$username = $rows['username'];
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

<body id="home">
	<?php include "includes/header.php" ?>

	<div class="container cf">
		<div class="sidebar">
			<div class="card mini-profile">
				<img src="img/default-pp.jpg" alt="" class="photo">
				<?php echo '<a class="profile" href="profile.php?profile_id='.$user_id.'">' ?>
					<p class="name"><?php echo "$fullname"; ?></p>
				</a>
				<?php
					$count_suggestions = "SELECT * FROM `music list` WHERE `added by` = '$user_id'";
					$fire_count_suggestions = mysqli_query($connection, $count_suggestions);
					$number_of_suggestions = 0;

					if($fire_count_suggestions){
						$number_of_suggestions = mysqli_num_rows($fire_count_suggestions);
					}
				?>
				<p class="info">you suggested <?php echo "$number_of_suggestions"; ?> song</p>
				<?php echo '<a href="profile_edit.php?profile_id='.$user_id.'" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i>Edit info</a>' ?>
			</div>
			<ul class="buttons">
				<li class="music">Discover New Songs</li>
					<li class="friends">Friends Suggestions</li>
			</ul>
		</div>
		<div class="card feed">
			<div class="music-content">
				<div>
				<?php
					$fetch_moods = "SELECT * FROM `moods` WHERE 1";
					$fire_fetch_moods = mysqli_query($connection, $fetch_moods);

					if($fire_fetch_moods){
						while ($rows = mysqli_fetch_array($fire_fetch_moods)) {
							$current_mood_id = $rows['id'];
							$current_mood_name = $rows['name'];

							$fetch_music = "SELECT * FROM `music list` WHERE `mood` = '$current_mood_id'";
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
													<img src="'.$music_picture.'" alt="Cant Feel my Face" class="pic">
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
			<div class="friends-content">

					<?php
							$fetch_friends = "SELECT * FROM `friends` WHERE `friend1_id` = '$user_id'";
							$fire_fetch_friends = mysqli_query($connection, $fetch_friends);

							// if(mysql_num_rows($fire_fetch_friends) == 0) {
							if(is_null($fire_fetch_friends)) {
							}
							if($fire_fetch_friends){
								$num_friends = mysqli_num_rows($fire_fetch_friends);
								if($num_friends == 0){
									echo '<p class="no-friends">You have no friends...Youre going to die alone! :(</p>
									</hr>';
								}
								while ($friend = mysqli_fetch_array($fire_fetch_friends)) {
									echo '<div class="friend">';
									$friend_id = $friend['friend2_id'];

									$get_friend_username = "SELECT * FROM `users` WHERE `id` = '$friend_id'";
									$fire_get_friend_username = mysqli_query($connection, $get_friend_username);

									if($fire_get_friend_username){
										while ($friendss = mysqli_fetch_array($fire_get_friend_username)) {
											$friend_username = $friendss['username'];
											echo '<div class="profile">
															<div class="pic"></div>
															<p class="name">'.$friend_username.' <span>has suggested these songs</span></p>
														</div>';
										}
									}

									$get_friend_music = "SELECT * FROM `music list` WHERE `added by` = '$friend_id'";
									$get_friend_music.=" ORDER BY id DESC LIMIT 3";
									$fire_get_friend_music = mysqli_query($connection, $get_friend_music);

									if($fire_get_friend_music){
										echo '<div class="latest-music">';
										$max_num_songs = 0;
										while (($friend_music = mysqli_fetch_array($fire_get_friend_music)) && ($max_num_songs <= 3)) {
											$friend_music_picture = $friend_music['picture'];
											$friend_music_name = $friend_music['name'];
											$friend_music_artist = $friend_music['artist'];
											$friend_music_youtube_link = $friend_music['youtube link'];

											echo '<div class="song card">
															<img src="'.$friend_music_picture.'" alt="Cant Feel my Face" class="pic">
															<p class="name">'.$friend_music_name.'</p>
															<p class="info">by <span>'.$friend_music_artist.'</span></p>
															<a href="'.$friend_music_youtube_link.'" target="_blank" class="yt-link"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
														</div>';
											$max_num_songs++;
										}
											echo '</div>
														<a class="cta" href="profile.php?profile_id='.$friend_id.'">View Profile</a>';
									}
									echo '</div>
												<hr/>';
								}
							}
					?>
		</div>
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/header.js"></script>
	<script type="text/javascript">
		$("document").ready(function() {
			$("#home .music-content").show();
			$("#home .friends-content").hide();

			if($(window).width() > 750){
				var sidebarWidth = $(".container").width() * 29 / 100;
				$(".sidebar").width(sidebarWidth);
			}

			$(window).resize(function() {
				if($(window).width() > 750){
					sidebarWidth = $(".container").width() * 29 / 100;
					$(".sidebar").width(sidebarWidth);
				}else{
					$(".sidebar").removeAttr('style');
				}
			});

			$("#home .sidebar ul.buttons li.music").click(function() {
				$("#home .music-content").show();
				$("#home .friends-content").hide();
			});
			$("#home .sidebar ul.buttons li.friends").click(function() {
				$("#home .music-content").hide();
				$("#home .friends-content").show();
			});
		});
	</script>
</body>

</html>
