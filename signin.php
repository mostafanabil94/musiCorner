<?php
  include 'includes/connection.php';
  $loginERR = "";
    if (isset($_GET['login'])) {
      if ($_GET['login'] == "empty") {
        $loginERR = "<div class='alert alert-danger'> inputs are empty </div>";
      }
      if ($_GET['login'] == "DB_error") {
        $loginERR = "<div class='alert alert-danger'> Data Base Error </div>";
      }
      if ($_GET['login'] == "error") {
        $loginRR = "<div class='alert alert-danger'> mail Or Password mismatch </div>";
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
    <?php echo "$loginERR"; ?>
		<img class="logo" src="img/Logo.png" alt="LOGO">
		<form class="signup" method="post" action="account/login.php">
			<h1>Login</h1>
			<input name="useremail" type="email" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder = 'Email'" required>
			<input name="userpassword" type="password" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder = 'Password'" required>
			<input name="login" type="submit" value="Login">
		</form>
	</div>

	<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
</body>

</html>
