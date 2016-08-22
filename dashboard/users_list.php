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
								<th>User ID</th>
								<th>User Full Name</th>
								<th>User Name</th>
								<th>User Email</th>
                <th>User Picture</th>
                <th>User Role</th>
								<th>Details</th>
								<th>Delete<th>
							</tr>
							<?php
								$get_users_query = "SELECT * FROM `users` WHERE 1";
								$fire_get_users = mysqli_query($connection, $get_users_query);
								while ($users = mysqli_fetch_array($fire_get_users)) {
									$person_id = $users['id'];
									$person_fullname = $users['full name'];
									$person_username = $users['username'];
									$person_email = $users['email'];
                  $person_picture = "../".$users['profile picture'];
                  $person_role = $users['role'];
									if($person_id == $user_id){
										echo '<tr>
														<td>'.$person_id.'</td>
														<td>'.$person_fullname.'</td>
														<td>'.$person_username.'</td>
														<td>'.$person_email.'</td>
														<td><img src='.$person_picture.' alt="..." width="80px"></td>
														<td>'.$person_role.'</td>
													</tr>';
									} else {
										echo '<tr>
														<td>'.$person_id.'</td>
														<td>'.$person_fullname.'</td>
														<td>'.$person_username.'</td>
														<td>'.$person_email.'</td>
														<td><img src='.$person_picture.' alt="..." width="80px"></td>
														<td>'.$person_role.'</td>
														<td><a href="user_profile.php?profile_id='.$person_id.'" class="btn btn-info btn-xs">Details</a></td>
														<td><a href="users_list.php?delete='.$person_id.'" class="btn btn-danger btn-xs">Delete</a></td>
													</tr>';
									}
								}
								if (isset($_GET['delete'])) {
				          $delete_id = $_GET['delete'];
				          $delete_user = "DELETE FROM `users` WHERE id='$delete_id'";

				          $fire_delete_user = mysqli_query($connection, $delete_user);

				          if ($fire_delete_user) {
				            echo "<script> alert('Done !') </script>";
				            echo "<script> window.open('users_list.php','_self') </script>";
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
