<?php
	session_start();
		include '../includes/connection.php';
		if (isset($_POST['login'])) {
			if (!empty($_POST['useremail']) && !empty($_POST['userpassword'])) {

				$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['useremail']));
				$password = mysqli_real_escape_string($connection, md5($_POST['userpassword']));

				$signin_query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";

				$result = mysqli_query($connection, $signin_query);

				if ($result = mysqli_query($connection, $signin_query)) {
					if (mysqli_num_rows($result) == 1) {
						while ($signin_row = mysqli_fetch_array($result)) {
							$_SESSION['id'] = $signin_row['id'];
							$_SESSION['email'] = $email;
							$_SESSION['password'] = $password;
							$_SESSION['profile picture'] = $signin_row['profile picture'];
							$_SESSION['username'] = $signin_row['username'];
							$_SESSION['role'] = $signin_row['role'];
						}
						if($_SESSION['role'] == 'admin'){
							header("Location:../dashboard/");
						} else {
							header("Location:../home.php");
						}

					}else {
						header("Location:../signin.php?login=error");
					}

				} else {
					header("Location:../signin.php?login=DB_error");
				}
			} else {
				header("Location:../signin.php?login=empty");
			}
		} else {
			header("Location:../signin.php");
		}
?>
