<?php
	session_start();
		include '../includes/connection.php';
		if (isset($_POST['login'])) {
			if (!empty($_POST['useremail']) && !empty($_POST['userpassword'])) {

				$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST['useremail']));
				$password = mysqli_real_escape_string($connection, md5($_POST['userpassword']));

				$signin_query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";

				$result = mysqli_query($connection, $signin_query);

				if ($result) {
					if (mysqli_num_rows($result) == 1) {
						$_SESSION['email'] = $email;
						$_SESSION['password'] = $password;
						header("Location: ../home.php");

					}else {
						header("Location: ../signin.php?login=error");
					}
				} else {
					header("Location: ../signin.php?login=DB_error");
				}
			} else {
				header("Location: ../signin.php?login=empty");
			}
		} else {
			header("Location: ../signin.php");
		}
?>
