<?php session_start();
	include 'includes/connection.php';
	if(isset($_SESSION['id']) && isset($_SESSION['email'])== true){

		$user_id	= $_SESSION['id'];
		$email 		= $_SESSION['email'];

		$profile_pic_query = "SELECT * FROM `users` WHERE `id` = '$user_id'";

		$result = mysqli_query($connection, $profile_pic_query);

			while($rows = mysqli_fetch_array($result)){
				if(mysqli_num_rows($result) == 1 ){
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
	<title>Search Results</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>

<body id="results">
	<?php include "includes/header.php"; ?>
	<div class="container card cf">
	<?php
			$search_value = '';
			if(isset($_GET['search'])){
				$search_value = $_GET['search'];
				echo '<h1><i class="fa fa-search"></i> Search results for "'.$search_value.'"</h1>';

				$search_by_music = "SELECT * FROM `music list` WHERE `name` LIKE '%$search_value%' OR `artist` LIKE '%$search_value%'";
				$fire_search_by_music = mysqli_query($connection, $search_by_music);

				if($fire_search_by_music){
					echo '<p class="category">Music</p>
								<hr/>
								<div class="music-results">';
					while ($music = mysqli_fetch_array($fire_search_by_music)) {
						$music_name = $music['name'];
						$music_artist = $music['artist'];
						$music_picture = $music['picture'];
						$music_youtube_link = $music['youtube link'];
						echo '
										<div class="song card">
											<div class="pic" style="background-image: url(&quot;'.$music_picture.'&quot;);"></div>
											<p class="name">'.$music_name.'</p>
											<p class="info">by <span>'.$music_artist.'</span></p>
											<a href="'.$music_youtube_link.'" target="_blank" class="yt-link"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
										</div>';
					}
					echo '</div>';
				}
			}

			$search_by_people = "SELECT * FROM `users` WHERE `username` LIKE '%$search_value%' OR
														`full name` LIKE '%$search_value%' OR `email` LIKE '%$search_value%'";
			$fire_search_by_people = mysqli_query($connection, $search_by_people);

			if($fire_search_by_people){
				echo '<p class="category">People</p>
							<hr/>
							<div class="people-results">';
				while ($people = mysqli_fetch_array($fire_search_by_people)) {
					$people_id = $people['id'];
					$people_name = $people['full name'];
					$people_profile_pic = $people['profile picture'];
					echo '<a href="profile.php?profile_id='.$people_id.'">
									<div class="account card">
										<div class="main-photo" style="background-image: url(&quot;'.$people_profile_pic.'&quot;);"></div>
										<p class="name">'.$people_name.'</p>
									</div>
								</a>';
				}
				echo '</div>';
			}

	 ?>




	</div>

	<script src="js/jquery.js"></script>
	<script src="js/header.js"></script>
</body>

</html>
