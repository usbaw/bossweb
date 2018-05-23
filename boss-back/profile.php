<?php

session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}
require_once("db.php");

$name = $designation = $email = $degree = $university = $city = $country = $skills = $aboutme = $profileimage = "";

$sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
$result = $conn->query($sql);

if($result->num_rows > 0) { 
  while($row = $result->fetch_assoc()) {
    $name = $row['name'];

    $email = $row['email'];
 
    $university = $row['university'];
    $city = $row['city'];
    $country = $row['country'];
  
    $aboutme = $row['aboutme'];
    $profileimage = $row['profileimage'];
  }
}

$_SESSION['callFrom'] = "profile.php";

?>
<?php
	$query = mysqli_query($conn, "select * from car_details where id_user='$_SESSION[id_user]'");
		if($result = mysqli_fetch_array($query)){
			$forcarbrand=$result['carbrand'];
			$forcartype=$result['cartype'];
			$forcarcolor=$result['carcolor'];
			$forplatenumber=$result['platenumber'];
			$foraboutcar=$result['aboutyourcar'];
			$forimg=$result['carimage'];
		}else{
      $forcarbrand="";
      $forcartype="";
      $forcarcolor="";
      $forplatenumber="";
      $foraboutcar="";
      $forimg="";
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Social Network</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
  <!-- jvectormap -->
  <!-- <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="dist/css/custom.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Header -->
  <?php include_once("header.php"); ?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php include_once("sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
            <?php 
                $sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  if($row['profileimage'] != '') {
                    echo '<img src="uploads/profile/'.$row['profileimage'].'" class="profile-user-img img-responsive img-circle" alt="User Image">';
                  } else {
                     echo '<img src="dist/img/avatar5.png" class="profile-user-img img-responsive img-circle" alt="User Image">';
                  }
                }
                ?>

              <h3 class="profile-username text-center"><?php echo $name; ?></h3>

              <p class="text-muted text-center"><?php echo $designation; ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <?php
                   $sql1 = "SELECT * FROM user_followers WHERE id_userfollower='$_SESSION[id_user]'";
                    $result1 = $conn->query($sql1);
                    if($result1->num_rows > 0) {
                      $totalno = $result1->num_rows;
                    } else {
                      $totalno = 0;
                    }
                  ?>
                  <b>Followers</b> <a class="pull-right"><?php echo $totalno; ?></a>
                </li>
                <li class="list-group-item">
                <?php
                   $sql1 = "SELECT * FROM user_followers WHERE id_user='$_SESSION[id_user]'";
                    $result1 = $conn->query($sql1);
                    if($result1->num_rows > 0) {
                      $totalno = $result1->num_rows;
                    } else {
                      $totalno = 0;
                    }
                  ?>
                  <b>Following</b> <a class="pull-right"><?php echo $totalno; ?></a>
                </li>
                <li class="list-group-item">
                   <?php
                   $sql1 = "SELECT * FROM friends WHERE id_user='$_SESSION[id_user]'";
                    $result1 = $conn->query($sql1);
                    if($result1->num_rows > 0) {
                      $totalno = $result1->num_rows;
                    } else {
                      $totalno = 0;
                    }
                  ?>
                  <b>Friends</b> <a class="pull-right"><?php echo $totalno; ?></a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $city; ?>, <?php echo $country; ?></p>

              <hr>


              <strong><i class="fa fa-file-text-o margin-r-5"></i> About Me</strong>

              <p><?php echo $aboutme; ?></p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
           <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
              <li><a href="#CARS" data-toggle="tab">Car Details</a></li>
              <li><a href="#settings" data-toggle="tab">Account Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Wall</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form class="form-horizontal" action="addpost.php" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                         <textarea class="form-control" name="description" placeholder="What's on your mind?" name="message"></textarea>
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-info">Post</button>
                      <div class="pull-right margin-r-5">
                        <label class="btn btn-warning">Image
                          <input type="file" name="image" id="ProfileImageBtn" accept=".png, .jpg, .jpeg">
                        </label>
                      </div>
                      <div class="pull-right margin-r-5">
                        <label class="btn btn-warning">Video
                          <input type="file" name="video" id="ProfileVideoBtn" accept=".mp4">
                        </label>
                      </div>
                      <div>
                        <?php if(isset($_SESSION['uploadError'])) { ?>
                          <p><?php echo $_SESSION['uploadError']; ?></p>
                        <?php unset($_SESSION['uploadError']); } ?>
                      </div>
                    </div>
                    <!-- /.box-footer -->
                  </form>
                </div>
                
                <?php
                $sql = "SELECT * FROM ( SELECT post.id_post, post.id_user, post.description, post.image, post.createdAt, post.video, post.youtube, users.name, users.profileimage, 'user' as type FROM post INNER JOIN users ON post.id_user=users.id_user WHERE post.id_user='$_SESSION[id_user]' UNION SELECT friend_posts.id_post, friend_posts.id_user, friend_posts.description, friend_posts.image, friend_posts.createdAt, friend_posts.video, friend_posts.youtube, users.name, users.profileimage, 'friend' as type FROM friend_posts INNER JOIN users ON friend_posts.id_user=users.id_user WHERE friend_posts.id_friend='$_SESSION[id_user]' ) posts ORDER BY posts.createdAt DESC";
                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                  while($row =  $result->fetch_assoc()) {
                    ?>
                      <!-- Box Comment -->
                      <div class="box box-widget">
                        <div class="box-header with-border">
                          <div class="user-block">
                            <?php
                          if($row['profileimage'] != '') {
                            echo '<img src="uploads/profile/'.$row['profileimage'].'" class="img-circle img-bordered-sm" alt="User Image">';
                          } else {
                             echo '<img src="dist/img/avatar5.png" class="img-circle img-bordered-sm" alt="User Image">';
                          }
                        ?>
                            <span class="username"><a href="#"><?php echo $row['name']; ?></a></span>
                            <span class="description">Shared publicly - <?php echo date('d-M-Y h:i a', strtotime($row['createdAt'])); ?></span>
                          </div>
                        </div>
                        <div class="box-body">
                        <?php
                          if($row['image'] != "") {
                            echo '<img class="img-responsive pad" src="uploads/post/'.$row['image'].'" alt="Photo">';
                          }

                          if($row['video'] != "") {
                            ?>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="embed-responsive embed-responsive-16by9">
                                    <video src="uploads/post/<?php echo $row['video']; ?>" controls></video>
                                  </div>
                                </div>
                              </div>
                            <?php
                          }

                          if($row['youtube'] != "") {
                            ?>
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="embed-responsive embed-responsive-16by9">
                                    <iframe src="https://www.youtube.com/embed/<?php echo $row['youtube']; ?>?rel=0&amp;showinfo=0" class="embed-responsive-item"></iframe>
                                  </div>
                                </div>
                              </div>
                            <?php
                          }
                        ?>
                          

                          <p><?php echo $row['description']; ?></p>
                          <?php
                          $sql1 = "SELECT * FROM likes WHERE id_user='$_SESSION[id_user]' AND id_post='$row[id_post]'";
                          $result1 = $conn->query($sql1);

                          if($result1->num_rows > 0) {
                            ?>
                            <button type="button" class="btn btn-default btn-xs" disabled><i class="fa fa-thumbs-o-up"></i> Like</button>

                            <?php
                          } else {
                            ?>
                               <button type="button" id="addLike" data-id="<?php echo $row['id_post']; ?>" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                            <?php
                          }
                          ?>   
                          <?php
                          $sql2 = "SELECT * FROM likes WHERE id_post='$row[id_post]'";
                          $result2 = $conn->query($sql2);
                          $totalLikes = (int)$result2->num_rows; 
                          ?>  
                          <?php
                          if($row['type'] == 'friend') {
                            $sql3="SELECT * FROM friends_comments WHERE id_post='$row[id_post]'";
                          } else {
                            $sql3="SELECT * FROM comments WHERE id_post='$row[id_post]'";
                          }
                          $result3 = $conn->query($sql3);
                          $totalComments = (int)$result3->num_rows; 
                          ?>                       
                          <span class="pull-right text-muted"><?php echo $totalLikes; ?> likes - <?php echo $totalComments; ?> comments</span>
                        </div>
                        <!-- /.box-body -->
                        <?php
                          if($row['type'] == 'friend') {
                            $sql4="SELECT * FROM friends_comments WHERE id_post='$row[id_post]' ORDER BY createdAt";
                          } else {
                            $sql4="SELECT * FROM comments WHERE id_post='$row[id_post]' ORDER BY createdAt";
                          }
                          $result4 = $conn->query($sql4);

                          if($result4->num_rows > 0) {
                            ?>
                        <div class="box-footer box-comments" style="display: block;">
                        <?php
                            while($row4 = $result4->fetch_assoc()) {
                              $sql5 = "SELECT * FROM users WHERE id_user='$row4[id_user]'";
                              $result5 = $conn->query($sql5);
                              if($result5->num_rows > 0) {
                                $row5 = $result5->fetch_assoc();
                              }
                          ?>

                          <div class="box-comment">
                          <?php
                              if($row5['profileimage'] != "") {
                                echo '<img class="img-circle img-sm" src="uploads/profile/'.$row5['profileimage'].'" alt="Photo">';
                              }
                            ?>
                            <div class="comment-text">
                                  <span class="username">
                                    <?php echo $row5['name']; ?>
                                    <span class="text-muted pull-right"><?php echo date('d-M-Y h:i a', strtotime($row4['createdAt'])); ?></span>
                                  </span>
                              <?php echo $row4['comment']; ?>
                            </div>
                          </div>

                          <?php
                          }
                        ?>

                        </div>
                        <?php } ?>
                        <!-- /.box-footer -->
                        <div class="box-footer">
                          <form action="#" method="post" onsubmit="return false;">
                          <?php
                              if($profileimage != "") {
                                echo '<img class="img-responsive img-circle img-sm" src="uploads/profile/'.$profileimage.'" alt="Photo">';
                              } else {
                             echo '<img src="dist/img/avatar5.png" class="img-responsive img-circle img-sm" alt="User Image">';
                          }
                            ?>
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            <div class="img-push">
                              <input type="text" data-id="<?php echo $row['id_post']; ?>" data-type="<?php echo $row['type']; ?>" class="addcomment form-control input-sm" onkeypress="checkInput(event, this);" placeholder="Press enter to post comment">
                            </div>
                          </form>
                        </div>
                        <!-- /.box-footer -->
                      </div>
                      <!-- /.box -->
                    <?php
                  }
                }
                ?>
                
<!--
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="dist/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                        </span>
                    <span class="description">Posted 5 photos - 5 days ago</span>
                  </div>
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="dist/img/photo1.png" alt="Photo">
                    </div>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          <img class="img-responsive" src="dist/img/photo2.png" alt="Photo">
                          <br>
                          <img class="img-responsive" src="dist/img/photo3.jpg" alt="Photo">
                        </div>
                        <div class="col-sm-6">
                          <img class="img-responsive" src="dist/img/photo4.jpg" alt="Photo">
                          <br>
                          <img class="img-responsive" src="dist/img/photo1.png" alt="Photo">
                        </div>
                      </div>
                    </div>
                  </div>

                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                 -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" method="post" action="updateprofileofuser.php" enctype="multipart/form-data">
                
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" id="inputName" placeholder="Name" value="<?php echo $name; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $email; ?>" disabled>
                    </div>
                  </div>
                  
                 
                 
				  
                  <div class="form-group">
                    <label for="inputCity" class="col-sm-2 control-label">City</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="city" id="inputCity" placeholder="City" value="<?php echo $city; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputCountry" class="col-sm-2 control-label">Country</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="country" id="inputCountry" placeholder="Country" value="<?php echo $country; ?>">
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="inputAboutMe" class="col-sm-2 control-label">About Me</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputAboutMe" name="aboutme" placeholder="About Me"><?php echo $aboutme; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputProfileImage" class="col-sm-2 control-label">Upload Profile Image</label>

                    <div class="col-sm-10">
                      <input type="file" id="inputProfileImage" name="image" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Update Profile</button>
                    </div>
                  </div>
                  </form>
              </div>


                <!-- CAR DETAILS -->
                <div class="tab-pane" id="CARS">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Car Brand</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="txtcarbrand" id="txtcarbrand" placeholder="Car brand" value="<?php echo $forcarbrand; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Car type</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="txtcartype" id="txtcartype" placeholder="Car type" value="<?php echo $forcartype; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Car Color</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="txtcarcolor" id="txtcarcolor" placeholder="Car color" value="<?php echo $forcarcolor; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Plate Number</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="txtplatenumber" id="txtplatenumber" placeholder="Plate Number" value="<?php echo $forplatenumber; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputAboutMe" class="col-sm-2 control-label">About your Car</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputAboutMe" name="aboutcar" placeholder="About your car"><?php echo $foraboutcar; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputProfileImage" class="col-sm-2 control-label">Upload Car Image</label>

                    <div class="col-sm-10">
                      <input type="file" id="file" name="image" class="form-control" alt="Car Image">
                      <input type="hidden" id="hiddenfirstphotopath" name="hiddenfirstphotopath" value="<?php echo $forimg; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger" name="submit">Submit</button>
                    </div>
                  </div>
                </form>
              </div>


              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018 <a href="#">Boss Cars</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
  $("#addLike").on("click", function() {
    var id_post = $(this).attr("data-id");
    $.post("addlike.php", {id:id_post}).done(function(data) {
      var result = $.trim(data);
      if(result == "ok") {
        location.reload();
      }
    });
  });
</script>
<script>
  function checkInput(e, t) {
    //13 means enter
    if(e.keyCode === 13) {
      var id_post = $(t).attr("data-id");
      var type = $(t).attr("data-type");
      var comment = $(t).val();
      var user = '<?php echo $_SESSION["id_user"]; ?>';
      if(type=="friend") {
        $.post("add-friends-comments.php", {id:id_post, comment:comment, user:user}).done(function(data) {
          var result = $.trim(data);
          if(result == "ok") {
            location.reload();
          }
        });
      } else {
        $.post("addcomment.php", {id:id_post, comment:comment, user:user}).done(function(data) {
          var result = $.trim(data);
          if(result == "ok") {
            location.reload();
          }
        });
      }
      return false;
    }
  }
</script>
<script>
$(document).ready(function(){
	$(document).on('change', '#file' , function(){
		
		var filesSelected = document.getElementById("file").files;
    if (filesSelected.length > 0)
    {
        var fileToLoad = filesSelected[0];

        if (fileToLoad.type.match("image.*"))
        {
            var fileReader = new FileReader();
            fileReader.onload = function(fileLoadedEvent)
			
            {
				document.getElementById("photoco").src=fileLoadedEvent.target.result;
		
				};
            fileReader.readAsDataURL(fileToLoad);
			var a =document.getElementById("file").value.split('\\');
			document.getElementById("hiddenfirstphotopath").value="uploads/carimages/<?php echo date('ljS\ofFY');?>"+a[2];
        }
    }
		var property = document.getElementById('file').files[0];
		var image_name = property.name;
		var image_extension = image_name.split('.').pop().toLowerCase();
		if(jQuery.inArray(image_extension, ['gif','jpeg','jpg','png']) == -1 ){
			alert ('Invalid Image File');
		}
		var image_size = property.size;
		if(image_size > 5000000){
			alert ('Image File is Too Big');
		}
		else{
			var form_data = new FormData();
			form_data.append("file", property);
			$.ajax({
				url:"upload_car_details.php",
				method:"POST",
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function(){
					$('uploaded_image').html("<label class='text-success'>Image Uploading... </label>");
				},
				success:function(data){
					$('#uploaded_image').html(data);
				}
				
			})
		}		
	});
	});
</script>
<?php
$var1=$_SESSION['id_user'];
	 if(isset($_POST['submit'])){
		$carbrand = $_POST["txtcarbrand"];
		$cartype = $_POST["txtcartype"];
		$carcolor = $_POST["txtcarcolor"];
		$platenumber = $_POST["txtplatenumber"];
		$aboutyourcar = $_POST["aboutcar"];
		$carimage = $_POST["hiddenfirstphotopath"];
		
		$query = mysqli_query($conn, "select * from car_details where id_user='$var1'");
		if($row = mysqli_fetch_array($query)){
			mysqli_query($conn,"UPDATE car_details SET  
							carbrand = '$carbrand', 
							cartype = '$cartype', 
							carcolor = '$carcolor', 
							platenumber = '$platenumber', 
							aboutyourcar = '$aboutyourcar', 
							carimage = '$carimage'
							WHERE id_user='$_SESSION[id_user]'
							");
							echo '<script language="javascript">';
							echo 'alert("Your Car Details is Succesfully Updated")';
							echo '</script>';
		}
		else{
		mysqli_query($conn,"INSERT INTO car_details SET 
							id_user = '$_SESSION[id_user]', 
							carbrand = '$carbrand', 
							cartype = '$cartype', 
							carcolor = '$carcolor', 
							platenumber = '$platenumber', 
							aboutyourcar = '$aboutyourcar', 
							carimage = '$carimage'");
							echo '<script language="javascript">';
							echo 'alert("Your Car Details Succesfully Saved")';
							echo '</script>';
	 }}
?>

</body>
</html>
