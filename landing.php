<?php include 'includes/connection.php';
  $usernameERR = $fullnameERR = $emailERR = $passwordERR = '';
		if($_SERVER['REQUEST_METHOD'] == "POST") {
				$username = strip_tags($_POST['username']);
        $fullname = strip_tags($_POST['fullname']);
				$email = htmlspecialchars($_POST['useremail']);
        $password = md5($_POST['userpassword']);

				if(empty($username)) $usernameERR  = "<div class='alert-danger'> Please Enter Your Username! </div>";
        if(empty($fullname)) $fullnameERR  = "<div class='alert-danger'> Please Enter Your Full Name! </div>";
      	if(empty($email)){
          $emailERR = "<div class='alert-danger'> Please Enter Your Email! </div>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailERR = "<div class='alert-danger'> Invalid Email Format! </div>";
        }
        if(empty($password)) $passwordERR  = "<div class='alert-danger'> Please Enter Your Password! </div>";

				$signup_query = "INSERT INTO `users`
				(`username`, `full name`, `email`, `password`)
				VALUES
				('$username', '$fullname', '$email', '$password')";

				$result = mysqli_query($connection, $signup_query);

				if($result){
					echo "<script> alert('Signup Successfull. Enjoy your own musiCorner ^_^') </script>";
				}
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>musiCorner</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="landing-container">
		<header class="cf">
			<button type="button" onclick="location.href = 'signin.php';" name="login">Login</button>
		</header>
		<div class="container">
			<img class="logo" src="img/Logo.png" alt="LOGO">
			<h1>Discover new music!</h1>
			<form class="signup" method="post" action="signin.php">
				<input name="username" type="text" placeholder="Username" onfocus="this.placeholder=''" onblur="this.placeholder = 'Username'" maxlength="20" required>
        <input name="fullname" type="text" placeholder="Full Name" onfocus="this.placeholder=''" onblur="this.placeholder = 'Full Name'" maxlength="50" required>
				<input name="useremail" type="email" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email'" required>
				<input name="userpassword" type="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password'" required>
				<input type="submit" value="Sign up">
				<p>or <a href="signin.php">Login</a></p>
			</form>
		</div>
	</div>


	<script>
		document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')
	</script>
	<script src="js/jquery.js"></script>
	<script type="text/javascript">
		$("document").ready(function(){
			$(".landing-container").height($(window).height());

			$(window).resize(function(){
			  $(".landing-container").height($(window).height());
			});
		});
	</script>
</body>

</html>
