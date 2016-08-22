<?php session_start();
	include 'includes/connection.php';
	if(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['password']) == true){

		$user_id	= $_SESSION['id'];

		$get_full_name = "SELECT * FROM `users` WHERE `id` = '$user_id'";
		$result = mysqli_query($connection, $get_full_name);

		if($result){
			while ($rows = mysqli_fetch_array($result)) {
					$username = $rows['username'];
					$fullname = $rows['full name'];
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
		<?php echo '<div class="main-photo" style="background-image: url(&quot;'.$profile_pic.'&quot;);"></div>' ?>
		<p class="full-name"><?php echo "$fullname" ?></p>

		<div method="post" class="edit-info">

			<h1>Edit your info</h1>
			<form class="edit-form" method="post" action="<?php echo "$_SERVER[PHP_SELF]"; ?>" enctype="multipart/form-data">
				<div class="group">
					<label>Profile Picture</label>
					<input name="profile-pic" type="file">
				</div>

				<input name="userfullname" type="text" placeholder="New Full Name" onfocus="this.placeholder=''" onblur="this.placeholder = 'New Full Name'" required>

				<input name="email" type="email" placeholder="New Email" onfocus="this.placeholder=''" onblur="this.placeholder = 'New Email'" required>

				<input name="password" type="password" placeholder="New Password" onfocus="this.placeholder=''" onblur="this.placeholder = 'New Pasword'" required>

				<input name="edit" type="submit" value="Save Changes">
			</form>
			<?php
				if($_SERVER['REQUEST_METHOD'] == "POST") {
					if(isset($_GET['profile_id'])) $profile_id = $_GET['profile_id'];
					$new_fullname = strip_tags($_POST['userfullname']);
					$new_email = htmlspecialchars($_POST['email']);
					$new_password = md5($_POST['password']);

					if($_FILES['profile-pic']['name'] != ''){
						$image_name = $_FILES['profile-pic']['name'];
						$image_tmp = $_FILES['profile-pic']['tmp_name'];
						$image_size = $_FILES['profile-pic']['size'];
						$image_ext = pathinfo($image_name,PATHINFO_EXTENSION);
						$image_path = 'img/'.$image_name;
						$image_db_path = 'img/'.$image_name;

						if($image_size < 5000000) {
							if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif'){
								if(move_uploaded_file($image_tmp,$image_path)){
									$update_profile = "UPDATE `users` SET `id` = '$user_id', `full name`= '$new_fullname', `email` = '$new_email',
																		`password`= '$new_password', `username` = '$username', `profile picture` = '$image_db_path'
																		WHERE `id` = '$user_id'";
									$fire_update_profile = mysqli_query($connection, $update_profile);
									if($fire_update_profile){
										$_SESSION['email'] = $new_email;
										echo '<script>alert("Profile changes done!");</script>';
										header('Location: home.php');
									} else {
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
							$new_fullname = strip_tags($_POST['userfullname']);
							$new_email = htmlspecialchars($_POST['email']);
							$new_password = md5($_POST['password']);

							$image_db_path = 'img//default-pp.jpg';
							$update_profile = "UPDATE `users` SET `id` = '$user_id', `full name`= '$new_fullname', `email` = '$new_email',
																`password`= '$new_password', `username` = '$username', `profile picture` = '$image_db_path'
																WHERE `id` = '$user_id'";
							$fire_update_profile = mysqli_query($connection, $update_profile);
							if($fire_update_profile){
								$_SESSION['email'] = $new_email;
								echo '<script>alert("Profile changes done!");</script>';
								header('Location: home.php');
							} else {
								echo '<div class="alert alert-danger">The Query Was not Working!</div>';
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
