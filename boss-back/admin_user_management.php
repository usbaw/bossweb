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
    $designation = $row['designation'];
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

$result_johnrey = mysqli_query($conn,"select * from users where user_type='0' and ban='0'");

$result_ban = mysqli_query($conn,"select * from users where user_type='0' and ban='1'");

if(isset($_POST['btnview'])){

  
$rid = $_POST['rid'];
if($rid == ""){
 echo '<script>alert("Select User First");</script>';
}else{
  echo "<script>window.location.href='admin_view_profile.php?id=$rid'</script>";
}

}

if(isset($_POST['btnyes'])){
  $rid = $_POST['rids'];
  $txtreason = $_POST['txtreason'];
if($rid == ""){
  echo '<script>alert("Select User First");</script>';
}else{
  mysqli_query($conn,"update users set ban='1',ban_reason='$txtreason' where id_user='$rid'");
  echo "<script>window.location.href='admin_user_management.php?id=$rid'</script>";
}
}

//UNBAN
if(isset($_POST['btnview_ban'])){

  
  $rid = $_POST['rid2'];
  if($rid == ""){
   echo '<script>alert("Select User First");</script>';
  }else{
    echo "<script>window.location.href='admin_view_profile.php?id=$rid'</script>";
  }
  
  }

//UNBAN
if(isset($_POST['btnyes_unban'])){
  $rid = $_POST['rid3'];
  
if($rid == ""){
  echo '<script>alert("Select User First");</script>';
}else{
  mysqli_query($conn,"update users set ban='0', ban_reason='' where id_user='$rid'");
  echo "<script>window.location.href='admin_user_management.php?id=$rid'</script>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>User Management</title>
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
<style>
            /* VISITED ROW */
            tr{cursor: pointer; transition: all .25s ease-in-out}
           .selected{background-color: red; font-weight: bold; color: #fff;}
           
</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Header -->
  <?php include_once("header.php"); ?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php include_once("sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

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
                    echo '<img src="uploads/profile/'.$row['profileimage'].'" class="profile-user-img img-responsive img-circle" style="width:100px;height:95px;"alt="User Image">';
                  } else {
                     echo '<img src="dist/img/avatar5.png" class="profile-user-img img-responsive img-circle" alt="User Image">';
                  }
                }
                ?>

              <h3 class="profile-username text-center"><?php echo $name; ?></h3>

            

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-file-text-o margin-r-5"></i> About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			  <?php echo $aboutme; ?>
            
         
              <hr>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <!-- <li class="active"><a href="#pending" data-toggle="tab">Create Admin</a></li> -->
              <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
              <li><a href="#held" data-toggle="tab">List of user</a></li>
              <li><a href="#abandon " data-toggle="tab">Banned User's</a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane" id="pending">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">You can create multiple admin account</h3>
                  </div>
                  <!-- /.box-header -->

                  <!-- form start -->
                  <form class="form-horizontal" method="post" action="updateprofile.php" enctype="multipart/form-data">
                
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" id="inputName" placeholder="Name"  required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputDesignation" class="col-sm-2 control-label">Designation</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="designation" id="inputDesignation" placeholder="Designation" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputDegree" class="col-sm-2 control-label">Degree</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="degree" id="inputDegree" placeholder="Degree" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputUniversity" class="col-sm-2 control-label">University</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="university" id="inputUniversity" placeholder="University" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputCity" class="col-sm-2 control-label">City</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="city" id="inputCity" placeholder="City" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputCountry" class="col-sm-2 control-label">Country</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="country" id="inputCountry" placeholder="Country" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputSkills" name="skills" placeholder="Skills (Space Separated)"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputAboutMe" class="col-sm-2 control-label">About Me</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputAboutMe" name="aboutme" placeholder="About Me"></textarea>
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
                      <button type="submit" class="btn btn-danger">Create Account</button>
                    </div>
                  </div>
                  </form>
            </div>
        </div>
  

        <div class="tab-pane" id="abandon">
        <!-- form start -->
        <div class="box-header with-border">
        <h3 class="box-title">Banned Users</h3>
        </div>
        <form class="form-horizontal"  method="post" target="blank" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                        <table class="table" id="table1">
                        <thead class="thead-dark">
                          <th >User ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Date Join</th>
                          <th>Country</th>

                          <!--<th>Action</th>-->
                        </thead>
                        <tr>
                      <?php while($row1 = mysqli_fetch_array($result_ban)):;?>
                      
                      <td><?php echo $row1['id_user'];?></td>
                      <td><?php echo $row1['name'];?></td>
                      <td><?php echo $row1['email'];?></td>
                      <td><?php echo $row1['createdAt'];?></td>
                      <td><?php echo $row1['country'];?></td>
                      </td>
                      </tr>  	<?php endwhile;?>
                      </table>
                      <input type="hidden" id="rid2" name="rid2">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                 
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <label class="btn btn-warning" data-toggle="modal" data-target="#myModal_unban">Unban
          
                        </label>
                      </div>
                      <div class="pull-right margin-r-5">
                      <input type="submit" name="btnview_ban" value="View User" class="btn btn-primary">
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


        <div class="active tab-pane" id="held">
        <!-- form start -->
        <div class="box-header with-border">
        <h3 class="box-title">List of users</h3>
        </div>
        <form class="form-horizontal" method="post"  target="blank" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                        <table class="table" id="table">
                        <thead class="thead-dark">
                          <th >User ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Date Join</th>
                          <th>Country</th>

                          <!--<th>Action</th>-->
                        </thead>
                        <tr>
                      <?php while($row1 = mysqli_fetch_array($result_johnrey)):;?>
                      
                      <td><?php echo $row1['id_user'];?></td>
                      <td><?php echo $row1['name'];?></td>
                      <td><?php echo $row1['email'];?></td>
                      <td><?php echo $row1['createdAt'];?></td>
                      <td><?php echo $row1['country'];?></td>
                      </td>
                      </tr>  	<?php endwhile;?>
                      </table>
                      <input type="hidden" id="rid" name="rid">
                          </div>
                        </div>
                      </div>
                      <!-- /.box-body -->

                    <div class="box-footer">
                    
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <label class="btn btn-warning" data-toggle="modal" data-target="#myModal">Ban
          
                        </label>
                      </div>
                      <div class="pull-right margin-r-5">
                      <input type="submit" name="btnview" value="View User" class="btn btn-primary">
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

  <!-- VIEW USER MODAL START -->
   <!-- Modal -->
   <form method="post">
   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ban user</h4>
        </div>
       
        <div class="modal-body">
   
          <p>Are you sure you want to ban, &nbsp; <?php echo $name?> &nbsp;?</p>
          <input type="hidden" id="rids" name="rids">

          <div class="form-group">
          <label for="inputAboutMe" class="col-sm-2 control-label">Reason</label>

          <div class="col-sm-10">
            <textarea class="form-control" id="inputAboutMe" name="txtreason" placeholder="Reason for ban" require></textarea>
          </div>
         </div>
         <br>

         <input type="submit" name="btnyes"  class="btn btn-warning" value="Yes">
          <button type="button" name="btnno" class="btn btn-primary" data-dismiss="modal">No</button>
         
    
   
        </div>  
       
        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        
        </div>
        
      </div>
      
    </div>
  </div>
  </form>
  <!-- VIEW USER MODAL END -->

  <!-- UNBAN USER MODAL START -->
   <!-- Modal -->
   <form method="post">
   <div class="modal fade" id="myModal_unban" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Unban user</h4>
        </div>
       
        <div class="modal-body">
   
          <p>Are you sure you want to Unban, &nbsp; <?php echo $name?> &nbsp;?</p>
          <input type="hidden" id="rid3" name="rid3">

         <br>

         <input type="submit" name="btnyes_unban"  class="btn btn-warning" value="Yes">
          <button type="button" name="btnno" class="btn btn-primary" data-dismiss="modal">No</button>
         
    
   
        </div>  
       
        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        
        </div>
        
      </div>
      
    </div>
  </div>
  </form>
  <!-- UNBAN USER MODAL END -->

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
<script>
          
    function selectedRow(){
        
        var index,
            table = document.getElementById("table");
    
        for(var i = 1; i < table.rows.length; i++)
        {
            table.rows[i].onclick = function()
            {
   

                  // remove the background from the previous selected row
                if(typeof index !== "undefined"){
                    table.rows[index].classList.toggle("selected");
                }
                console.log(typeof index);
                // get the selected row index
                
                index = this.rowIndex;
                // add class selected to the row
                document.getElementById("rid").value = this.cells[0].innerHTML;
                document.getElementById("rids").value = this.cells[0].innerHTML;

                this.classList.toggle("selected");
                // Get the value for the selected row
              

                console.log(typeof index);

            
              };
        }
        
    }
    selectedRow();

</script>
<script>
          
          function selectedRow(){
              
              var index,
                  table = document.getElementById("table1");
          
              for(var i = 1; i < table.rows.length; i++)
              {
                  table.rows[i].onclick = function()
                  {
         
      
                        // remove the background from the previous selected row
                      if(typeof index !== "undefined"){
                          table.rows[index].classList.toggle("selected");
                      }
                      console.log(typeof index);
                      // get the selected row index
                      
                      index = this.rowIndex;
                      // add class selected to the row
                      document.getElementById("rid2").value = this.cells[0].innerHTML;
                      document.getElementById("rid3").value = this.cells[0].innerHTML;

      
                      this.classList.toggle("selected");
                      // Get the value for the selected row
                    
      
                      console.log(typeof index);
      
                  
                    };
              }
              
          }
          selectedRow();
      
      </script>
