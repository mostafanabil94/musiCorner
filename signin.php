<?php include 'includes/connection.php';
  $usernameERR = $passwordERR = '';
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			  $email = htmlspecialchars($_POST['useremail']);
        $password = md5($_POST['userpassword']);

      	if(empty($email)){
          $emailERR = "<div class='alert-danger'> Please Enter Your Email! </div>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailERR = "<div class='alert-danger'> Invalid Email Format! </div>";
        }
        if(empty($password)) $passwordERR  = "<div class='alert-danger'> Please Enter Your Password! </div>";

				$signin_query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";

				$result = mysqli_query($connection, $signin_query);
				if($result){
					echo "<script> alert('Login Successfull. Enjoy your own musiCorner ^_^') </script>";
				} else {
						echo "<script> alert('Login Failed! :( )') </script>";
				}
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Welcome Back!</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="container signin">
		<img class="logo" src="img/Logo.png" alt="LOGO">
		<form class="signup" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
			<h1>Login</h1>
			<input name="useremail" type="email" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email'" required>
			<input name="userpassword" type="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password'" required>
			<input type="submit" value="Login">
		</form>
	</div>

	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>

</html>
