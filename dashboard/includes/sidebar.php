<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <?php echo '<img src="../'.$profile_pic.'" class="user-circle" alt="User Image">'; ?>
      </div>
      <div class="pull-left info">
        <?php echo '<p>'.$fullname.'</p>' ?>
      </div>
    </div>
    <?php
      $search = '';
      if (isset($_GET['search'])) {
        $search = $_GET['search'];
      }
      echo '<form action="search_result.php?search='.$search.'" method="get" class="sidebar-form">';
    ?>
      <div class="input-group">
        <input name="search" type="text" name="q" class="form-control" placeholder="Search...">
      </div>
    </form>
    <ul class="sidebar-menu">
      <li class="header">HEADER</li>
      <li class="active"><a href="users_list.php"><i class="fa fa-user"></i> <span>Browse Users</span></a></li>
      <li><a href="music_list.php"><i class="fa fa-music"></i> <span>Browse Music</span></a></li>
      <li><a href="moods_list.php"><i class="fa fa-list"></i> <span>Browse Moods</span></a></li>
      <li><a href="friends_list.php"><i class="fa fa-users"></i> <span>Browse Friends</span></a></li>
    </ul>
  </section>
</aside>
