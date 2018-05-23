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
                    echo '<img src="uploads/profile/'.$row['profileimage'].'" class="profile-user-img img-responsive img-circle" style="width:50px;height:45px;" alt="User Image">';
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
	  
	  <?php 
		$sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
		  $row = $result->fetch_assoc();
		   if($row['user_type'] == '0') { // EQUAL TO 0 OR USER
			   
			   echo '
		
				  <ul class="sidebar-menu" data-widget="tree">
					<li>
					  <a href="profile.php">
						<i class="fa fa-user-o"></i> <span>Profile</span>
					  </a>
					</li>
					<li>
					  <a href="index.php">
						<i class="fa fa-clone"></i> <span>News Feed</span>
					  </a>
					</li>
					<li>
					  <a href="user_boss_cars_event.php">
						<i class="fa fa-newspaper-o"></i> <span>Boss Cars Events</span>
					  </a>
					</li>
			
					<li>
					  <a href="messages.php">
						<i class="fa fa-wechat"></i> <span>Messages</span>
					  </a>
					</li>
					<li>
					  <a href="friends.php">
						<i class="fa fa-users"></i> <span>Friends</span>
					  </a>
					</li>
					<li>
					  <a href="friend-request.php">
						<i class="fa fa-server"></i> <span>Friend Request</span>
					  </a>
					</li>
					<li>
					  <a href="events.php">
						<i class="fa fa-calendar"></i> <span>Calendar of Activities</span>
					  </a>
					</li>
					<li>
					  <a href="photos.php">
						<i class="fa  fa-file-photo-o"></i> <span>Gallery</span>
					  </a>
					</li>
					<li>
					  <a href="../index.php">
						<i class="fa  fa-reply"></i> <span>Back to website</span>
					  </a>
					</li>
				  </ul>
				   ';
				   
			 } else if($row['user_type'] == '1') { //EQUAL TO 1 OR ADMIN
				echo '
				
				
			  <ul class="sidebar-menu" data-widget="tree">
				<li>
				  <a href="admin_profile.php">
					<i class="fa fa-user-o"></i> <span>Profile</span>
				  </a>
				</li>

				<li>
				  <a href="admin_boss_cars_event.php">
					<i class="fa fa-calendar-check-o"></i> <span>Boss Cars Events</span>
				  </a>
				</li>
				<li>
				  <a href="admin_flyer_advertisement.php">
					<i class="fa fa-quote-left"></i> <span>Flyers / Advertisement</span>
				  </a>
				</li>
				<li>
				  <a href="admin_user_management.php">
					<i class="fa fa-drivers-license-o"></i> <span>User Management</span>
				  </a>
				</li>
				<li>
				  <a href="admin_blogs.php">
					<i class="fa fa-pencil-square-o"></i> <span>Create Blogs</span>
				  </a>
				</li>
			   
				<li>
				  <a href="admin_event.php">
					<i class="fa fa-calendar"></i> <span>Calendar of Activities</span>
				  </a>
				</li>
				<li>
				<li>
				  <a href="admin_photos.php">
					<i class="fa  fa-file-photo-o"></i> <span>Gallery</span>
				  </a>
				</li>
				<li>
				  <a href="../index.php">
					<i class="fa  fa-reply"></i> <span>Back to Website</span>
				  </a>
				</li>
			  </ul>
			</section>
		
			  
				';
			} else if($row['user_type'] == '2') { //EVENT ORGANIZER
				echo '
				
					<ul class="sidebar-menu" data-widget="tree">
				
					<li>
					  <a href="admin_profile.php">
						<i class="fa fa-user-o"></i> <span>Profile</span>
					  </a>
					</li>

					<li>
					  <a href="organizer_boss_cars_event.php">
						<i class="fa fa-calendar-check-o"></i> <span>Boss Cars Events</span>
					  </a>
					</li>
					<li>
					  <a href="organizer_flyers_advertisement.php">
						<i class="fa fa-quote-left"></i> <span>Flyers / Advertisement</span>
					  </a>
					</li>
					<li>
					  <a href="admin_event.php">
						<i class="fa fa-calendar"></i> <span>Calendar of Activities</span>
					  </a>
					</li>
					<li>
					
					<li>
					  <a href="../index.php">
						<i class="fa  fa-reply"></i> <span>Back to Website</span>
					  </a>
					</li>
				  </ul>
				</section>
				';
			  }
		}
	  ?>
	  
      
    </section>
    <!-- /.sidebar -->
  </aside>