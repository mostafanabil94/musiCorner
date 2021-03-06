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
								<th>Music ID</th>
								<th>Music Name</th>
								<th>Music Artist</th>
								<th>Music Youtube Link</th>
                <th>Music Picture</th>
                <th>Added By</th>
								<th>Details</th>
								<th>Delete</th>
							</tr>
							<?php
								$get_music_query = "SELECT * FROM `music list` WHERE 1";
								$fire_get_music = mysqli_query($connection, $get_music_query);
								while ($music = mysqli_fetch_array($fire_get_music)) {
									$music_id = $music['id'];
									$music_name = $music['name'];
									$music_artist = $music['artist'];
                  $music_link = $music['youtube link'];
                  $music_picture = "../".$music['picture'];
                  $music_addedby = $music['added by'];
                  if($music_addedby != ''){
                    $added_by_query = "SELECT * FROM `users` WHERE `id` = '$music_addedby'";
                    $result = mysqli_query($connection, $added_by_query);
              			while($rows = mysqli_fetch_array($result)){
                        $music_addedby = $rows['username'];
                    }
                  }
									echo '<tr>
													<td>'.$music_id.'</td>
													<td>'.$music_name.'</td>
													<td>'.$music_artist.'</td>
													<td><a href="'.$music_link.'">'.$music_link.'</a></td>
                          <td><img src='.$music_picture.' alt="..." width="50px"></td>
                          <td>'.$music_addedby.'</td>
													<td><a href="music_profile.php?music_id='.$music_id.'" class="btn btn-info btn-xs">Details</a></td>
													<td><a href="music_list.php?delete='.$music_id.'" class="btn btn-danger btn-xs">Delete</a></td>
												</tr>';
								}
								if (isset($_GET['delete'])) {
				          $delete_id = $_GET['delete'];
				          $delete_music = "DELETE FROM `music list` WHERE id='$delete_id'";

				          $fire_delete_music = mysqli_query($connection, $delete_music);

				          if ($fire_delete_music) {
				            echo "<script> alert('Done !') </script>";
				            echo "<script> window.open('music_list.php','_self') </script>";
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
