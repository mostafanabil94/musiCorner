<?php session_start();
	include 'includes/connection.php';
	if(isset($_SESSION['email']) && isset($_SESSION['password']) == true){

		$email 		= $_SESSION['email'];
		$password = $_SESSION['password'];

		$homepage_query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";

		$result = mysqli_query($connection, $homepage_query);

			while($rows = mysqli_fetch_array($result)){
				if(mysqli_num_rows($result) == 1 ){
					$user_id = $rows['id'];
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
	<header class="card cf">
		<a href="#">
			<div class="add">
				<i class="fa fa-headphones" aria-hidden="true"></i>
				<i class="fa fa-plus" aria-hidden="true"></i>
			</div>
		</a>
		<img class="logo" src="img/Logo.png" alt="LOGO">
		<div class="search-box">
			<span class="icon"><i class="fa fa-search"></i></span>
			<input type="search" id="search" placeholder="Search..." />
		</div>
		<a href="#">
			<div class="profile">
				<p><?php echo "$username"; ?></p>
				<div class="photo"></div>
			</div>
		</a>
	</header>


	<div class="container cf">
		<div class="sidebar">
			<div class="card mini-profile">
				<div class="photo"></div>
				<p class="name"><?php echo "$fullname"; ?></p>
				<?php
					$count_suggestions = "SELECT * FROM `music list` WHERE `added by` = '$user_id'";
					$fire_count_suggestions = mysqli_query($connection, $count_suggestions);
					$number_of_suggestions = 0;

					if($fire_count_suggestions){
						$number_of_suggestions = mysqli_num_rows($fire_count_suggestions);
					}
				?>
				<p class="info">you suggested <?php echo "$number_of_suggestions"; ?> song</p>
				<button class="edit"><i class="fa fa-pencil" aria-hidden="true"></i>Edit info</button>
			</div>
			<ul class="buttons">
				<li class="music">Music Suggestions</li>
				<li class="friends">Friends</li>
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
							echo '<p class="mood">'.$current_mood_name.'</p>
										<hr/>';
							$fetch_music = "SELECT * FROM `music list` WHERE `mood` = '$current_mood_id'";
							$fire_fetch_music = mysqli_query($connection, $fetch_music);

							if($fire_fetch_music){
								while ($music = mysqli_fetch_array($fire_fetch_music)) {
									$music_name = $music['name'];
									$music_artist = $music['artist'];
									$music_picture = $music['picture'];
									$music_youtube_link = $music['youtube link'];
									echo '	<div class="song card">
														<img src="'.$music_picture.'" alt="Cant Feel my Face" class="pic">
														<p class="name">'.$music_name.'</p>
														<p class="info">by <span>'.$music_artist.'</span></p>
														<button class="yt-link"><a href="'.$music_youtube_link.'" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></button>
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

							if($fire_fetch_friends){
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
									$fire_get_friend_music = mysqli_query($connection, $get_friend_music);

									echo '<div class="latest-music">';
									if($fire_get_friend_music){
										//<!-- Maximum 3 songs -->//
										while ($friend_music = mysqli_fetch_array($fire_get_friend_music)) {
											$friend_music_picture = $friend_music['picture'];
											$friend_music_name = $friend_music['name'];
											$friend_music_artist = $friend_music['artist'];
											$friend_music_youtube_link = $friend_music['youtube link'];

											echo '<div class="song card">
															<img src="'.$friend_music_picture.'" alt="Cant Feel my Face" class="pic">
															<p class="name">'.$friend_music_name.'</p>
															<p class="info">by <span>'.$friend_music_artist.'</span></p>
															<button class="yt-link"><a href="'.$music_youtube_link.'" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></button>
														</div>';
										}
											echo '</div>
														<a href="#">View Profile</a>';
									}
									echo '</div>
												<hr/>';
								}
							}

					?>
		</div>
	</div>

	<script>
		document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')
	</script>

	<script src="js/jquery.js"></script>
	<script type="text/javascript">
		$("document").ready(function() {
			$("#home .music-content").show();
			$("#home .friends-content").hide();

			var sidebarWidth = $(".container").width() * 29 / 100;
			$(".sidebar").width(sidebarWidth);

			$(window).resize(function() {
				sidebarWidth = $(".container").width() * 29 / 100;
				$(".sidebar").width(sidebarWidth);
			});

			$("#home .sidebar ul.buttons li.music").click(function(){
				$("#home .music-content").show();
				$("#home .friends-content").hide();
			});
			$("#home .sidebar ul.buttons li.friends").click(function(){
				$("#home .music-content").hide();
				$("#home .friends-content").show();
			});
		});
	</script>
</body>

</html>
