<header class="card cf">
  <a href="addsong.php">
    <div class="add">
      <i class="fa fa-headphones" aria-hidden="true"></i>
      <i class="fa fa-plus" aria-hidden="true"></i>
    </div>
  </a>
  <a href="home.php"><img class="logo" src="img/Logo.png" alt="LOGO"></a>
  <?php
  $search = '';
  if (isset($_GET['search'])) {
    $search = $_GET['search'];
  }
  echo '<form action="results.php?search_value='.$search.'">'; ?>
    <div class="search-box" >
      <div class="search">
        <span class="icon"><i class="fa fa-search"></i></span>
        <input name="search" type="search" id="search" placeholder="Search..." />
      </div>
    </div>
  </form>
  <div class="profile">
    <?php
      $username = '';
      $profpic = '';
      $get_username = "SELECT * FROM `users` WHERE `id` = '$user_id'";
      $fire_get_username = mysqli_query($connection, $get_username);

      while ($rows = mysqli_fetch_array($fire_get_username)) {
          $username = $rows['username'];
          $profpic = $rows['profile picture'];
      }
    ?>
    <p><?php echo "$username"?></p>
    <?php echo '<div class="photo" style="background-image: url(&quot;'.$profpic.'&quot;);"></div>' ?>
    <ul class="profile-dropdown">
      <a href="home.php">
        <li>Home <i class="fa fa-home" aria-hidden="true"></i></li>
      </a>
      <?php echo '<a href="profile.php?profile_id='.$user_id.'">' ?>
        <li>View Profile</li>
      </a>
      <?php echo '<a href="profile_edit.php?profile_id='.$user_id.'">'; ?>
        <li>Edit Profile</li>
      </a>
      <a href="account/logout.php">
        <li>Logout <i class="fa fa-sign-out"></i></li>
      </a>
    </ul>
  </div>
</header>
