  <header id="header" class="main-header" style="background-color:black;">

    
	<?php 
	$sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
	  $row = $result->fetch_assoc();

	  if($row['user_type'] == '0') {
		echo '
			  <!-- Logo -->
			  <a href="#" class="logo" style="background-color:black;">
			  <!-- mini logo for sidebar mini 50x50 pixels -->
			  <span class="logo-mini" style="background-color:black;"><b>U</b>D</span>
			  <!-- logo for regular state and mobile devices -->
			  <span class="logo-lg" style="background-color:black;"><b>User </b>Dashboard <!-- <img src="1.png" height="50px">--> </span>
			  </a>
		';
	  } else if($row['user_type'] == '1') {
		echo '
			  <!-- Logo -->
			  <a href="#" class="logo" style="background-color:black;">
			  <!-- mini logo for sidebar mini 50x50 pixels -->
			  <span class="logo-mini" style="background-color:black;"><b>A</b>D</span>
			  <!-- logo for regular state and mobile devices -->
			  <span class="logo-lg" style="background-color:black;"><b>Admin </b>Dashboard <!-- <img src="1.png" height="50px">--> </span>
			  </a>
		';
	  } else if($row['user_type'] == '2') {
		echo '
			  <!-- Logo -->
			  <a href="#" class="logo" style="background-color:black;">
			  <!-- mini logo for sidebar mini 50x50 pixels -->
			  <span class="logo-mini" style="background-color:black;"><b>E</b>O</span>
			  <!-- logo for regular state and mobile devices -->
			  <span class="logo-lg" style="background-color:black;"><b>Event </b> Organizer <!-- <img src="1.png" height="50px">--> </span>
			  </a>
		';
	  }
	}
	?>


    <?php

    $sql = "SELECT id_from, COUNT(id_from) as total FROM messages WHERE id_to='$_SESSION[id_user]' AND viewed='0' GROUP BY id_from";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
      $totalUnreadMessages =  $result->num_rows;
    } else {
      $totalUnreadMessages = 0;
    }
	$uid=$_SESSION['id_user'];
	$data=mysqli_query($conn,"select * from users where id_user='$uid'");
	if($result=mysqli_fetch_array($data)){
		$datecreated=$result['createdAt'];
		$datec=date('F Y', strtotime($datecreated));
	}
    ?>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color:#1c1c1c;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
                   <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php if($totalUnreadMessages > 0) { ?>
              <span class="label label-warning"><?php echo $totalUnreadMessages; ?></span>
              <?php } ?>
            </a>
            <?php if($totalUnreadMessages > 0) { ?>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $totalUnreadMessages; ?> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php
                  while($row = $result->fetch_assoc()) {
                    $sqlUser = "SELECT name FROM users WHERE id_user='$row[id_from]'";
                    $resultUser = $conn->query($sqlUser);
                    $rowName = $resultUser->fetch_assoc();
                  ?>

                  <li>
                    <a href="messages.php?id=<?php echo $row['id_from']; ?>" style="white-space: inherit;">
                      <i class="fa fa-user text-red"></i> You have <?php echo $row['total']; ?> unread message(s) from <?php echo $rowName['name']; ?>
                    </a>
                  </li>
                  <?php } ?>
                </ul>
              </li>
            </ul>
            <?php } else { ?>
            <ul class="dropdown-menu">
              <li class="header">You have 0 notifications</li>
            </ul>
            <?php } ?>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php 
                $sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  if($row['profileimage'] != '') {
                    echo '<img src="uploads/profile/'.$row['profileimage'].'" class="img-circle" alt="User Image" style="width: 25px; height: 25px;">';
                  } else {
                     echo '<img src="dist/img/avatar5.png" class="img-circle" alt="User Image" style="width: 25px; height: 25px;">';
                  }
                  $username = $row['name'];
                }
                ?>
              <span class="hidden-xs"><?php echo $username; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background-color:#1c1c1c">

              <?php 
                $sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  if($row['profileimage'] != '') {
                    echo '<img src="uploads/profile/'.$row['profileimage'].'" class="profile-user-img img-responsive img-circle" style="width:50px;height:45px;" alt="User Image">';
                  } else {
                    echo '<img src="dist/img/avatar5.png" class="profile-user-img img-responsive img-circle" style="width:50px;height:45px;" alt="User Image">';
                  }
                }
                ?>
             

                <p>
                  <?php echo $name; ?> - <?php echo $designation; ?>
                  <small>Member since <?php echo $datec;?></small>
                </p>
              </li>
			  
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>