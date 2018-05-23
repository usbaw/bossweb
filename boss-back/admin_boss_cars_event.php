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
<?php
$datetoday=date("Y-m-d");
$sql = "UPDATE boss_event SET status='Held' where end_date<'$datetoday'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Boss Cars Event</title>
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
                    echo '<img src="uploads/profile/'.$row['profileimage'].'" class="profile-user-img img-responsive img-circle" style="width:100px;height:95px;" alt="User Image">';
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
              <li class="active"><a href="#pending" data-toggle="tab">Pending Events</a></li>
              <li><a href="#ongoing" data-toggle="tab">Ongoing Events</a></li>
              <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
              <li><a href="#held" data-toggle="tab">Event Held</a></li>
              <li><a href="#abandon " data-toggle="tab">Abandoned Events</a></li>
            </ul>

            <div class="tab-content">
              <div class="active tab-pane" id="pending">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h6>List of Paid Events published by the Event Organizer</h6>
                  </div>
                  <!-- /.box-header -->

                  <!-- form start -->
                  <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                        <table class="table table-bordered" id="table">
                            <th>ID</th>
                            <th>Event Organizer</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start and End Date</th>
                            <?php
								$query = mysqli_query($conn, "select * from boss_event where status='Paid'");
								  while($result = mysqli_fetch_array($query)){
									$id=$result['id_event'];
									$id_user=$result['id_user'];
									$title=$result['title'];
									$caption=$result['caption'];
									$description=$result['description'];
									$start_date=$result['start_date'];
									$end_date=$result['end_date'];
									$place=$result['place'];
									$picture=$result['picture'];
									$query1 = mysqli_query($conn, "select * from users where id_user='$id_user'");
									if($result1 = mysqli_fetch_array($query1)){
									  $name=$result1['name'];
									  echo'
									  <tr>
									 <td>'.$id.'</td>
									 <td>'.$name.'</td>
									 <td>'.$title.'</td>
									 <td>'.$description.'</td>
									 <td>'.$start_date.' | '.$end_date.'</td>
								</tr>
								
									';
									}
								}
							?>
                        </table>
						<input type="hidden" name="idofevent" id="idofevent">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      
                      <div class="pull-right margin-r-5">
					    <button type="submit" class="btn btn-info" name="approve"><i class="fa fa-thumbs-o-up"></i> &nbsp;&nbsp;Approve Event</button>
                        <button type="submit" class="btn btn-info" name="cancel"><i class="fa fa-thumbs-down"></i> &nbsp;&nbsp; Cancel</button>
                    	<button type="submit" name="view_paid" class="btn btn-info"><i class="fa fa-eye"></i> &nbsp;&nbsp; View</button>
					</div>
                      <div class="pull-right margin-r-5">
                        
                      </div>

                      <div>
                        <?php if(isset($_SESSION['uploadError'])) { ?>
                          <p><?php echo $_SESSION['uploadError']; ?></p>
                        <?php unset($_SESSION['uploadError']); } ?>
                      </div>
                    </div>
                    <!-- /.box-footer -->
					<?php
						if(isset($_POST['approve'])){
							$idofevent = $_POST['idofevent'];
							echo '<script>window.location.href="update_ongoing.php?id='.$idofevent.'"</script>';
						//echo '<script>alert('.$idofevent.');</script>';
						}
						else if(isset($_POST['cancel'])){
							$idofevent = $_POST['idofevent'];
							echo '<script>window.location.href="abandon_event.php?id='.$id.'"</script>';
				
						}
						
						if(isset($_POST['view_paid'])){
						$idofevent = $_POST['idofevent'];
						echo "<script>window.location.href='view_event.php?id=$idofevent';</script>";
						}
		
						if(isset($_POST['view_abandoned'])){
						$id_abandoned = $_POST['id_abandoned'];
						echo "<script>window.location.href='view_event.php?id=$id_abandoned';</script>";			
						}
						
						if(isset($_POST['view_ongoing'])){
						$id_ongoing = $_POST['id_ongoing'];
						echo "<script>window.location.href='view_event.php?id=$id_ongoing';</script>";			
						}
						
						if(isset($_POST['view_held'])){
						$id_held = $_POST['id_held'];
						echo "<script>window.location.href='view_event.php?id=$id_held';</script>";			
						}
					?>
                </form>
            </div>
        </div>
  
		<div class="tab-pane" id="ongoing">
        <!-- form start -->
        <div class="box-header with-border">
        <h6>List of events that you gived approval</h6>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                        <table class="table table-bordered" id="table_ongoing">
                            <th>ID</th>
                            <th>Event Organizer</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start and End Date</th>
                            <?php
								$query = mysqli_query($conn, "select * from boss_event where status='Ongoing'");
								  while($result = mysqli_fetch_array($query)){
									$id=$result['id_event'];
									$id_user=$result['id_user'];
									$title=$result['title'];
									$caption=$result['caption'];
									$description=$result['description'];
									$start_date=$result['start_date'];
									$end_date=$result['end_date'];
									$place=$result['place'];
									$picture=$result['picture'];
									$query1 = mysqli_query($conn, "select * from users where id_user='$id_user'");
									if($result1 = mysqli_fetch_array($query1)){
									  $name=$result1['name'];
									  echo'
									  <tr>
									 <td>'.$id.'</td>
									 <td>'.$name.'</td>
									 <td>'.$title.'</td>
									 <td>'.$description.'</td>
									 <td>'.$start_date.' | '.$end_date.'</td>
								</tr>
								
									';
									}
								}
							?>
                        </table>
						<input type="hidden" name="id_ongoing" id="id_ongoing">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                 
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <button type="submit" name="view_ongoing"class="btn btn-info"><i class="fa fa-eye"></i> &nbsp;&nbsp;View Details </button>
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
		
        <div class="tab-pane" id="abandon">
        <!-- form start -->
        <div class="box-header with-border">
        <h6>List of all abandoned events</h6>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                        <table class="table table-bordered" id="table_abandoned">
                            <th>ID</th>
                            <th>Event Organizer</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start and End Date</th>
                            <?php
								$query = mysqli_query($conn, "select * from boss_event where status='Abandoned'");
								  while($result = mysqli_fetch_array($query)){
									$id=$result['id_event'];
									$id_user=$result['id_user'];
									$title=$result['title'];
									$caption=$result['caption'];
									$description=$result['description'];
									$start_date=$result['start_date'];
									$end_date=$result['end_date'];
									$place=$result['place'];
									$picture=$result['picture'];
									$query1 = mysqli_query($conn, "select * from users where id_user='$id_user'");
									while($result1 = mysqli_fetch_array($query1)){
									  $name=$result1['name'];
									  echo'
									  <tr>
									 <td>'.$id.'</td>
									 <td>'.$name.'</td>
									 <td>'.$title.'</td>
									 <td>'.$description.'</td>
									 <td>'.$start_date.' | '.$end_date.'</td>
								</tr>
								
									';
									}
								}
							?>
                        </table>
						<input type="hidden" name="id_abandoned" id="id_abandoned">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                 
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <button type="submit" name="view_abandoned" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Details   </button>
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
        <h6>List of all events that held</h6>
		<input type="hidden" id="DATE" name="DATE">
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                        <table class="table table-bordered" id="table_held">
                             <th>ID</th>
                            <th>Event Organizer</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start and End Date</th>
                            <?php
								$query = mysqli_query($conn, "select * from boss_event where status='Held'");
								  while($result = mysqli_fetch_array($query)){
									$id=$result['id_event'];
									$id_user=$result['id_user'];
									$title=$result['title'];
									$name=$result1['name'];
									$caption=$result['caption'];
									$description=$result['description'];
									$start_date=$result['start_date'];
									$end_date=$result['end_date'];
									$place=$result['place'];
									$picture=$result['picture'];
									$query1 = mysqli_query($conn, "select * from users where id_user='$id_user'");
									if($result1 = mysqli_fetch_array($query1)){
									  $name=$result1['name'];
									  echo'
									  <tr>
									 <td>'.$id.'</td>
									 <td>'.$name.'</td>
									 <td>'.$title.'</td>
									 <td>'.$description.'</td>
									 <td>'.$start_date.' | '.$end_date.'</td>
								</tr>
								
									';
									}
								}
							?>
							<input type="hidden" name="id_held" id="id_held">
                        </table>
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <button type="submit" name="view_held" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Details</button>
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
<!--Select Row-->
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
                
						document.getElementById("idofevent").value = this.cells[0].innerHTML;
                      
					  index = this.rowIndex;
                      // add class selected to the row

                      this.classList.toggle("selected");
                      // Get the value for the selected row
                    
      
                      console.log(typeof index);
      
                  
                    };
              }
              
          }
          selectedRow();
      
      </script>
	  
 <!--Select Row-->
 <script>
          
          function selectedRow(){
              
              var index,
                  table = document.getElementById("table_ongoing");
          
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
                
						document.getElementById("id_ongoing").value = this.cells[0].innerHTML;
                      
					  index = this.rowIndex;
                      // add class selected to the row

                      this.classList.toggle("selected");
                      // Get the value for the selected row
                    
      
                      console.log(typeof index);
      
                  
                    };
              }
              
          }
          selectedRow();
      
      </script>
	   <!--Select Row-->
      <script>
          
          function selectedRow(){
              
              var index,
                  table = document.getElementById("table_held");
          
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
                
						document.getElementById("id_held").value = this.cells[0].innerHTML;
                      
					  index = this.rowIndex;
                      // add class selected to the row

                      this.classList.toggle("selected");
                      // Get the value for the selected row
                    
      
                      console.log(typeof index);
      
                  
                    };
              }
              
          }
          selectedRow();
      
      </script>
	  	   <!--Select Row-->
      <script>
          
          function selectedRow(){
              
              var index,
                  table = document.getElementById("table_abandoned");
          
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
                
						document.getElementById("id_abandoned").value = this.cells[0].innerHTML;
                      
					  index = this.rowIndex;
                      // add class selected to the row

                      this.classList.toggle("selected");
                      // Get the value for the selected row
                    
      
                      console.log(typeof index);
      
                  
                    };
              }
              
          }
          selectedRow();
      
      </script>
</body>
</html>
