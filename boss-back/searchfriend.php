        <?php
		include 'db.php';
			$nme=$_GET['name'];
			$id_user=$_GET['uid'];
			if($nme <> ""){
			$sql2 = "SELECT * FROM users WHERE id_user <> '$_SESSION[id_user]' and name LIKE '%$nme%'"; // <>   != 
       			 $result = $conn->query($sql2);
          if($result->num_rows > 0) { 
            while($row2 = $result->fetch_assoc()) {
		  
		
		
        ?>
                   <div class="box box-widget widget-user"  >
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header " style="background-color:#1c1c1c;">
              <h3 class="widget-user-username"><font color="white"><?php echo $row2['name']; ?></font></h3>
              <h5 class="widget-user-desc"><font color="white"><?php echo $row2['designation']; ?></font></h5>
            </div>
            <?php if($row2['profileimage'] != "") { ?>
            <div class="widget-user-image" >
              <img class="img-circle" src="uploads/profile/<?php echo $row2['profileimage']; ?>" alt="User Avatar">
            </div>
            <?php } else { ?>
            <div class="widget-user-image" >
              <img class="img-circle" src="dist/img/avatar5.png" alt="User Avatar">
            </div>
            <?php } ?>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right" >
                  <?php
                $sql21 = "SELECT * FROM friends WHERE id_user='$id_user' AND id_frienduser='$row2[id_user]'";
                  $result1 = $conn->query($sql21);

                  if($result1->num_rows > 0) { 
                                
                ?>
                  <div class="description-block">
                    <a href="messages.php?id=<?php echo $row2['id_user']; ?>" class="btn bg-purple bg-flat">Send Message</a>
                  </div>
                  <?php  } ?>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <a href="view-profile.php?id=<?php echo $row2['id_user']; ?>" class="btn bg-maroon bg-flat">View Profile</a>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                <?php
                $sql21 = "SELECT * FROM friends WHERE id_user='$id_user' AND id_frienduser='$row2[id_user]'";
                  $result1 = $conn->query($sql21);

                  if($result1->num_rows > 0) { 
                                
                ?>
                  <div class="description-block">
                    <a href="remove-friend.php?id=<?php echo $row2['id_user']; ?>" class="btn bg-orange bg-flat">Remove Friend</a>
                  </div>
                <?php 
			} else {
                    $sql22 = "SELECT * FROM friendrequest WHERE id_user='$row2[id_user]' AND id_friend='$_SESSION[id_user]'";
                    $result2 = $conn->query($sql22);

                    if($result2->num_rows == 0) { 

                    $sql23 = "SELECT * FROM friendrequest WHERE id_user = '$_SESSION[id_user]' AND id_friend='$row2[id_user]'"; 
                      $result3 = $conn->query($sql23);
                      if($result3->num_rows == 0) { 
                    ?>
                    <div class="description-block">
                      <a href="send-request.php?id=<?php echo $row2['id_user']; ?>" class="btn bg-green bg-flat">Add Friend</a>
                    </div>
                  <?php } else { ?>
                  <div class="description-block">
                      <a href="accept-request.php?id=<?php echo $row2['id_user']; ?>" class="btn bg-maroon bg-flat">Accept Friend</a>
                  </div>
                  <?php } ?>
                    <?php } else {?>
                    <div class="description-block">
                      <button class="btn bg-purple bg-flat" disabled>Request Sent</button>
                    </div>
                    
                  <?php } } ?>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
        <?php
			}
          }
		  }else{

			?>
			
			
			
			 <?php
			$sql = "SELECT * FROM users WHERE id_user <> '$_SESSION[id_user]'"; // <>   != 
          $result = $conn->query($sql);
          if($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
             $id_friend=$row['id_user'];
			 //$id_user=$_SESSION['id_user'];
				$data=mysqli_query($conn,"select * from friends where id_user='$id_user'");
				while($result2=mysqli_fetch_array($data)){
				if($result2['id_frienduser']==$id_friend){
					
				
				
        ?>
          <div class="box box-widget widget-user"  >
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header " style="background-color:#1c1c1c;">
              <h3 class="widget-user-username"><font color="white"><?php echo $row['name']; ?></font></h3>
              <h5 class="widget-user-desc"><font color="white"><?php echo $row['designation']; ?></font></h5>
            </div>
            <?php if($row['profileimage'] != "") { ?>
            <div class="widget-user-image" >
              <img class="img-circle" src="uploads/profile/<?php echo $row['profileimage']; ?>" alt="User Avatar">
            </div>
            <?php } else { ?>
            <div class="widget-user-image" >
              <img class="img-circle" src="dist/img/avatar5.png" alt="User Avatar">
            </div>
            <?php } ?>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right" >
                  <?php
                $sql1 = "SELECT * FROM friends WHERE id_user='$id_user' AND id_frienduser='$row[id_user]'";
                  $result1 = $conn->query($sql1);

                  if($result1->num_rows > 0) { 
                                
                ?>
                  <div class="description-block">
                    <a href="messages.php?id=<?php echo $row['id_user']; ?>" class="btn bg-purple bg-flat">Send Message</a>
                  </div>
                  <?php  } ?>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <a href="view-profile.php?id=<?php echo $row['id_user']; ?>" class="btn bg-maroon bg-flat">View Profile</a>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                <?php
                $sql1 = "SELECT * FROM friends WHERE id_user='$id_user' AND id_frienduser='$row[id_user]'";
                  $result1 = $conn->query($sql1);

                  if($result1->num_rows > 0) { 
                                
                ?>
                  <div class="description-block">
                    <a href="remove-friend.php?id=<?php echo $row['id_user']; ?>" class="btn bg-orange bg-flat">Remove Friend</a>
                  </div>
                <?php 
			} else {
                    $sql2 = "SELECT * FROM friendrequest WHERE id_user='$row[id_user]' AND id_friend='$_SESSION[id_user]'";
                    $result2 = $conn->query($sql2);

                    if($result2->num_rows == 0) { 

                    $sql3 = "SELECT * FROM friendrequest WHERE id_user = '$_SESSION[id_user]' AND id_friend='$row[id_user]'"; 
                      $result3 = $conn->query($sql3);
                      if($result3->num_rows == 0) { 
                    ?>
                    <div class="description-block">
                      <a href="send-request.php?id=<?php echo $row['id_user']; ?>" class="btn bg-green bg-flat">Add Friend</a>
                    </div>
                  <?php } else { ?>
                  <div class="description-block">
                      <a href="accept-request.php?id=<?php echo $row['id_user']; ?>" class="btn bg-maroon bg-flat">Accept Friend</a>
                  </div>
                  <?php } ?>
                    <?php } else {?>
                    <div class="description-block">
                      <button class="btn bg-purple bg-flat" disabled>Request Sent</button>
                    </div>
                    
                  <?php } } ?>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
        <?php
			}}}
          }}
        ?>
			
			