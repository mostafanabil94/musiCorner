<?php session_start();
	include 'includes/connection.php';
	if(isset($_SESSION['email']) && isset($_SESSION['password']) == true){

		$email = $_SESSION['email'];

		$homepage_query = "SELECT * FROM `users` WHERE `email` = '$email'";

		$result = mysqli_query($connection, $homepage_query);

			while($rows = mysqli_fetch_array($result)){
				if(mysqli_num_rows($result) == 1 ){
					$user_id = $rows['id'];
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
	<title>Add a new Song</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
</head>

<body id="add">
	<?php include "includes/header.php" ?>

	<div class="container card cf">

		<h1><i class="fa fa-music"></i></h1>
		<h1>Add a new Song</h1>

		<form class="add" action="" method="post" enctype="multipart/form-data">
			<input name="songname" type="text" placeholder="Song Name" onfocus="this.placeholder=''" onblur="this.placeholder = 'Song Name'" required>

			<input name="artist" type="text" placeholder="Artist" onfocus="this.placeholder=''" onblur="this.placeholder = 'Artist'" required>

			<input name="link" type="text" placeholder="Youtube Link" onfocus="this.placeholder=''" onblur="this.placeholder = 'Youtube Link'" required>

			<div class="group">
				<label>Song Picture</label>
				<input name="photo" type="file">
			</div>

			<div class="group">
				<label>Mood</label>
				<select name="mood">

					<?php
						$fetch_moods = "SELECT * FROM `moods` WHERE 1";
						$fire_fetch_moods = mysqli_query($connection, $fetch_moods);

						if($fire_fetch_moods){
							while ($rows = mysqli_fetch_array($fire_fetch_moods)) {
								$current_mood_id = $rows['id'];
								$current_mood_name = $rows['name'];
								echo '<option value="'.$current_mood_id.'">'.$current_mood_name.'</option>';
							}
						}
					?>
				</select>
			</div>

			<input name="submit" type="submit" value="Add">

		</form>
		<?php
			if(isset($_POST['submit'])){
				$songname = strip_tags($_POST['songname']);
				$artist = strip_tags($_POST['artist']);
				$link = strip_tags($_POST['link']);

				if($_POST['mood'] != ''){
					$mood = $_POST['mood'];
				}

				if($_FILES['photo']['name'] != ''){
					$image_name = $_FILES['photo']['name'];
					$image_tmp = $_FILES['photo']['tmp_name'];
					$image_size = $_FILES['photo']['size'];
					$image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
					$image_path = 'img/'.$image_name;
					$image_db_path = 'img/'.$image_name;

					if($image_size < 5000000) {
						if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif'){
							if(move_uploaded_file($image_tmp,$image_path)){
								$add_song_query = "INSERT INTO `music list`
								(`name`, `picture`, `youtube link`, `mood`, `added by`, `artist`)
								VALUES
								('$songname', '$image_db_path', '$link', '$mood', '$user_id', '$artist')";
								$result = mysqli_query($connection ,$add_song_query);
								if($result){
									header('Location: profile.php?profile_id='.$user_id.'');
								}else {
									echo '<div class="alert alert-danger">The Query Was not Working!</div>';
								}
							}else{
								echo '<div class="alert alert-danger">Sorry, Unfortunately Image hos not been uploaded!</div>';
							}

						} else {
							echo '<div class="alert alert-danger">Image Format was not Correct!</div>';
						}

					} else {
						echo '<div class="alert alert-danger">Image File Size is much bigger then Expect!</div>';
					}
				} else {
						$songname = strip_tags($_POST['songname']);
						$artist = strip_tags($_POST['artist']);
						$link = strip_tags($_POST['link']);
						if($_POST['mood'] != ''){
							$mood = $_POST['mood'];
						}
						$image_db_path = 'img/default-song-img.jpg';
						$add_song_query = "INSERT INTO `music list`
						(`name`, `picture`, `youtube link`, `mood`, `added by`, `artist`)
						VALUES
						('$songname', '$image_db_path', '$link', '$mood', '$user_id', '$artist')";
						$result = mysqli_query($connection ,$add_song_query);
						if($result){
							header('Location: profile.php?profile_id='.$user_id.'');
						}else {
							echo '<div class="alert alert-danger">The Query Was not Working!</div>';
						}
					}
				}
		 ?>
	</div>

	<script src="js/jquery.js"></script>
	<script src="js/header.js"></script>
</body>

</html>
