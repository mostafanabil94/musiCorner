<?php session_start();
	include '../includes/connection.php';
	if(isset($_SESSION['email']) && isset($_SESSION['password']) == true){

		$current_email = $_SESSION['email'];
		$homepage_query = "SELECT * FROM `users` WHERE `email` = '$current_email'";

		$result = mysqli_query($connection, $homepage_query);

			while($rows = mysqli_fetch_array($result)){
				if(mysqli_num_rows($result) == 1 ){
					$user_id = $rows['id'];
					$email = $rows['email'];
					$password = $rows['password'];
					$fullname = $rows['full name'];
					$username = $rows['username'];
					$profile_pic = $rows['profile picture'];
				}
			}
	} else {
		header('Location: home.php');
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MusiCorner | Dashboard</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
			<?php include "includes/header.php" ?>
			<?php include "includes/sidebar.php" ?>

      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            MusiCorneR | DashBoard
          </h1>
        </section>

				<section class="clearfix content">
					<div class="col-md-10">
						<table class="table table-hover">
							<tr class="success active">
								<th>Mood ID</th>
								<th>Mood Name</th>
								<th>Delete</th>
							</tr>
							<?php
								$get_mood_query = "SELECT * FROM `moods` WHERE 1";
								$fire_get_moods = mysqli_query($connection, $get_mood_query);
								while ($moods = mysqli_fetch_array($fire_get_moods)) {
									$mood_id = $moods['id'];
									$mood_name = $moods['name'];
									echo '<tr>
													<td>'.$mood_id.'</td>
													<td>'.$mood_name.'</td>
													<td><a href="moods_list.php?delete='.$mood_id.'" class="btn btn-danger btn-xs">Delete</a></td>
												</tr>';
								}
								if (isset($_GET['delete'])) {
				          $delete_id = $_GET['delete'];
				          $delete_mood = "DELETE FROM `moods` WHERE id='$delete_id'";

				          $fire_delete_mood = mysqli_query($connection, $delete_mood);

				          if ($fire_delete_mood) {
				            echo "<script> alert('Done !') </script>";
				            echo "<script> window.open('moods_list.php','_self') </script>";
				          }
				        }
							 ?>
						</table>
					</div>
				</section>
      </div>

      <?php echo include 'includes/footer.php'; ?>
			<?php echo include 'includes/sidebar-control.php'; ?>

    </div>

  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="dist/js/app.min.js"></script>

  </body>
</html>
