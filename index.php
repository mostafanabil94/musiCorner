<?php include 'includes/connection.php';
  $usernameERR = $fullnameERR = $emailERR = $passwordERR = '';
		if($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = strip_tags($_POST['username']);
        $fullname = strip_tags($_POST['fullname']);
				$email = htmlspecialchars($_POST['useremail']);
        $password = md5($_POST['userpassword']);

        $check_username = "SELECT * FROM `users` WHERE `username` = '$username'";
        $fire_check_username = mysqli_query($connection, $check_username);

        if(empty($username)) $usernameERR = "<p class='validation'> Please Enter Your Username! </p>";
        while ($selected_username = mysqli_fetch_array($fire_check_username)) {
            $name = $selected_username['username'];
            if($name == $username) $usernameERR = "<p class='validation'> Sorry but this Username is already used. Try another one. </p>";
        }

        $check_email = "SELECT * FROM `users` WHERE `email` = '$email'";
        $fire_check_email = mysqli_query($connection, $check_email);

        if(empty($email)){
          $emailERR = "<p class='validation'> Please Enter Your Email! </p>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailERR = "<p class='validation'> Invalid Email Format! </p>";
        }

        while ($selected_email = mysqli_fetch_array($fire_check_email)) {
            $user_email = $selected_email['email'];
            if($email == $user_email) $emailERR = "<p class='validation'> Sorry but this Email is already used. Try another one. </p>";
        }

        if(empty($fullname)) $fullnameERR  = "<div class='alert-danger'> Please Enter Your Full Name! </div>";
        if(empty($password)) $passwordERR  = "<div class='alert-danger'> Please Enter Your Password! </div>";

				if (($usernameERR == '') && ($fullnameERR == '') && ($emailERR == '') && ($passwordERR == '')) {
          $signup_query = "INSERT INTO `users`
  				(`username`, `full name`, `email`, `password`)
  				VALUES
  				('$username', '$fullname', '$email', '$password')";

  				$result = mysqli_query($connection, $signup_query);

  				if($result){
  					echo "<script> alert('Signup Successfull. Enjoy your own musiCorner ^_^') </script>";
  				}
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
			<form class="signup" method="post" action="landing.php">
        <input name="fullname" type="text" placeholder="Full Name" onfocus="this.placeholder=''" onblur="this.placeholder = 'Full Name'" maxlength="50" required>
        <input name="username" type="text" placeholder="Username" onfocus="this.placeholder=''" onblur="this.placeholder = 'Username'" maxlength="30" required></input>
				    <?php echo "$usernameERR" ?>
        <input name="useremail" type="email" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email'" required>
            <?php echo "$emailERR" ?>
        <input name="userpassword" type="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password'" required>
				<input type="submit" value="Sign up">
        <p class="login">or <a href="signin.php">Login</a></p>
			</form>
		</div>
	</div>

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
