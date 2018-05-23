<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php 
                $sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  if($row['profileimage'] != '') {
                    echo '<img src="uploads/profile/'.$row['profileimage'].'" class="img-circle" alt="User Image">';
                  } else {
                    echo '<img src="dist/img/avatar5.png" class="img-circle" alt="User Image">';
                  }
                  $username = $row['name'];
                }
                ?>
        </div>
        <div class="pull-left info">
          <p><?php echo $username; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu  -->
      <ul class="sidebar-menu" data-widget="tree">
        <li <?php if($_SESSION['callFrom'] == "admin_profile.php") { echo 'class="active"'; } ?>>
          <a href="admin_profile.php">
            <i class="fa fa-user-o"></i> <span>Profile</span>
          </a>
        </li>

        <li <?php if($_SESSION['callFrom'] == "admin_boss_cars_event.php") { echo 'class="active"'; } ?>>
          <a href="admin_boss_cars_event.php">
            <i class="fa fa-calendar-check-o"></i> <span>Boss Cars Events</span>
          </a>
        </li>
        <li <?php if($_SESSION['callFrom'] == "admin_flyer_advertisement.php") { echo 'class="active"'; } ?>>
          <a href="admin_flyer_advertisement.php">
            <i class="fa fa-quote-left"></i> <span>Flyers / Advertisement</span>
          </a>
        </li>
        <li <?php if($_SESSION['callFrom'] == "admin_user_management.php") { echo 'class="active"'; } ?>>
          <a href="admin_user_management.php">
            <i class="fa fa-drivers-license-o"></i> <span>User Management</span>
          </a>
        </li>
        <li <?php if($_SESSION['callFrom'] == "admin_blogs.php") { echo 'class="active"'; } ?>>
          <a href="admin_blogs.php">
            <i class="fa fa-pencil-square-o"></i> <span>Create Blogs</span>
          </a>
        </li>
       
        <li <?php if($_SESSION['callFrom'] == "admin_event.php") { echo 'class="active"'; } ?>>
          <a href="admin_event.php">
            <i class="fa fa-calendar"></i> <span>Calendar of Activities</span>
          </a>
        </li>
        <li>
        <li <?php if($_SESSION['callFrom'] == "admin_photos.php") { echo 'class="active"'; } ?>>
          <a href="admin_photos.php">
            <i class="fa  fa-file-photo-o"></i> <span>Gallery</span>
          </a>
        </li>
        <li <?php if($_SESSION['callFrom'] == "../index.php") { echo 'class="active"'; } ?>>
          <a href="../index.php">
            <i class="fa  fa-reply"></i> <span>Back to Website</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>