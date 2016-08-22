<header class="main-header">
  <a href="index.php" class="logo">
    <span class="logo-mini"><b>MC</b></span>
    <span class="logo-lg"><b>MusiCorneR</b></span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php echo '<img src="../'.$profile_pic.'" class="user-image" alt="User Image">'; ?>
            <?php echo '<span class="hidden-xs">'.$fullname.'</span>'; ?>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <?php echo '<img src="../'.$profile_pic.'" class="user-circle" alt="User Image">'; ?>
              <p>
                <?php echo "$fullname" ?> - 	Web Developer
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <?php echo '<a href="user_profile.php?profile_id='.$user_id.'" class="btn btn-default btn-flat">Profile</a>'; ?>
              </div>
              <div class="pull-right">
                <a href="../account/logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
