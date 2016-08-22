<?php
  include 'includes/connection.php';
  $loginErr = "";
    if (isset($_GET['login'])) {
      if ($_GET['login'] == "empty") {
        $loginErr = "<p class='validation'> inputs are empty </p>";
      }
      if ($_GET['login'] == "DB_error") {
        $loginErr = "<p class='validation'> Database Error </p>";
      }
      if ($_GET['login'] == "error") {
        $loginErr = "<p class='validation'>Wrong Email/Password !</p>";
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
  <link rel="icon" href="img/favicon.ico">
</head>

<body>
	<div class="container signin">
		<img class="logo" src="img/Logo.png" alt="LOGO">
		<form class="signup card" method="post" action="account/login.php">
			<h1>Login</h1>
      <?php echo "$loginErr" ?>
			<input name="useremail" type="email" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email'" required>
			<input name="userpassword" type="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password'" required>
			<input name="login" type="submit" value="Login">
		</form>
	</div>

	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>

</html>
