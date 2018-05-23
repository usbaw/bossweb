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
    $designation = $row['designation'];
    $email = $row['email'];
    $degree = $row['degree'];
    $university = $row['university'];
    $city = $row['city'];
    $country = $row['country'];
    $skills= $row['skills'];
    $aboutme = $row['aboutme'];
    $profileimage = $row['profileimage'];
  }
}

$_SESSION['callFrom'] = "admin_profile.php";

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
  <?php include_once("admin_header.php"); ?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php include_once("admin_sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content-header">
      <h1>
        Admin Profile
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
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
              
              <?php if($degree != "" && $university != "") { ?>
              <p class="text-muted">
                <?php echo $degree; ?> from <?php echo $university; ?>
              </p>
              <?php  } ?>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?php echo $city; ?>, <?php echo $country; ?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
              
              <p>
              <?php 

              $arr = explode(" ", $skills);

              $colors = array("label-danger", "label-success", "label-info", "label label-warning", "label-primary");

              foreach ($arr as $key => $value) {
                $c = array_rand($colors);
                $v = $colors[$c];
                ?>
                <span class="label <?php echo $v; ?>"><?php echo $value; ?></span>
                <?php
              } 
              ?>
              </p>

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
              <li class="active"><a href="#pending" data-toggle="tab">Write Blogs</a></li>
              <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
              <li><a href="#held" data-toggle="tab">Blogs Created</a></li>
              <li><a href="#abandon " data-toggle="tab">Blogs Deleted</a></li>
            </ul>

            <div class="tab-content">
              <div class="active tab-pane" id="pending">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Write your blogs</h3>
                  </div>
                  <!-- /.box-header -->

                  <!-- form start -->
                  <form class="form-horizontal" method="post" action="updateprofile.php" enctype="multipart/form-data">
                
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Blog Title</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" id="inputName" placeholder="Blog Title"  required>
                    </div>
                  </div>
        
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Blog caption</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputSkills" name="skills" placeholder="Blog caption"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputAboutMe" class="col-sm-2 control-label">Your Blog</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputAboutMe" name="aboutme" placeholder="Write your blog"></textarea>
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
                      <button type="submit" class="btn btn-danger">Publish</button>
                    </div>
                  </div>
                  </form>
            </div>
        </div>
  

        <div class="tab-pane" id="abandon">
        <!-- form start -->
        <div class="box-header with-border">
        <h3 class="box-title">Blogs Deleted</h3>
        </div>
        <form class="form-horizontal" action="addpost.php" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search Blogs"> <p>
                        <table class="table table-bordered">
                             <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Profile</th>
                            <th>User Type</th>
                            <th>Car Details</th>
                            <tr>
                                <td>01145</td>
                                <td>Juan, Dela Cruz</td>
                                <td>UK</td>
                                <td>Feb 4, 1996</td>
                                <td>User</td>
                                <td>Ferrari</td>
                            </tr>
                            <tr>
                                <td>01145</td>
                                <td>Juan, Dela Cruz</td>
                                <td>UK</td>
                                <td>Feb 4, 1996</td>
                                <td>User</td>
                                <td>Ferrari</td>
                            </tr>
                            <tr>
                                <td>01145</td>
                                <td>Juan, Dela Cruz</td>
                                <td>UK</td>
                                <td>Feb 4, 1996</td>
                                <td>User</td>
                                <td>Ferrari</td>
                            </tr>
                        </table>
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                 
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <label class="btn btn-success">Recycle Blog
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


        <div class="tab-pane" id="held">
        <!-- form start -->
        <div class="box-header with-border">
        <h3 class="box-title">Blogs Created</h3>
        </div>
        <form class="form-horizontal" action="addpost.php" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search Blogs"> <p>
                        <table class="table table-bordered">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Profile</th>
                            <th>User Type</th>
                            <th>Car Details</th>
                            <tr>
                                <td>01145</td>
                                <td>Juan, Dela Cruz</td>
                                <td>UK</td>
                                <td>Feb 4, 1996</td>
                                <td>Admin</td>
                                <td>Ferrari</td>
                            </tr>
                            <tr>
                                <td>01145</td>
                                <td>Juan, Dela Cruz</td>
                                <td>UK</td>
                                <td>Feb 4, 1996</td>
                                <td>Admin</td>
                                <td>Ferrari</td>
                            </tr>
                            <tr>
                                <td>01145</td>
                                <td>Juan, Dela Cruz</td>
                                <td>UK</td>
                                <td>Feb 4, 1996</td>
                                <td>User</td>
                                <td>Ferrari</td>
                            </tr>
                        </table>
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <label class="btn btn-warning">Delete
                          <input type="file" name="video" id="ProfileVideoBtn" accept=".mp4">
                        </label>
                      </div>
                      <div class="pull-right margin-r-5">
                        <label class="btn btn-success">Edit
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
</body>
</html>
