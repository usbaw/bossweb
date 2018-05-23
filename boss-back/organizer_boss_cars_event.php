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
  <title>Boss Cars event</title>
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

     <!--PAYPAL SCRIPTS-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>


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
    <section class="content-header">
      <h1>
        Event's Management
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
                    echo '<img src="uploads/profile/'.$row['profileimage'].'" class="profile-user-img img-responsive img-circle" style="width:100px;height:95px;" alt="User Image">';
                  } else {
                     echo '<img src="dist/img/avatar5.png" class="profile-user-img img-responsive img-circle" alt="User Image">';
                  }
                }
                ?>

              <h3 class="profile-username text-center"><?php echo $name; ?></h3>

              <p class="text-muted text-center"><?php echo $designation; ?></p>


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
              <li class="active"><a href="#Create" data-toggle="tab">Create Events</a></li>
              <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
              <li><a href="#pending" data-toggle="tab">My Events</a></li>
              <li><a href="#ongoing" data-toggle="tab">Ongoing Events</a></li>
              <li><a href="#held" data-toggle="tab">Event Held</a></li>
              <li><a href="#abandon " data-toggle="tab">Abandoned Events</a></li>
            </ul>

            <div class="tab-content">
              <div class="active tab-pane" id="Create">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Create Events</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form class="form-horizontal" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Event Title</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="txttitle" id="inputName" placeholder="Event Title"  required>
                  </div>
                </div>
      
                <div class="form-group">
                  <label for="inputSkills" class="col-sm-2 control-label">Event Bio</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputSkills" name="txteventbio" placeholder="Event Bio"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAboutMe" class="col-sm-2 control-label">Description</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputAboutMe" name="txtdescription" placeholder="Event Description"></textarea>
                  </div>
                </div>
                <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Start Date</label>
				
                <div class="col-sm-10">
                    <input type="date" id="date" data-provide="datepicker" id="from" class="form-control" name="startdate" id="inputName" placeholder="Event Date"  required min="<?php echo date("Y-m-d"); ?>">
                  </div>
                </div>
				
                <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">End Date</label>
                <div class="col-sm-10">
                    <input type="date" id="to" class="form-control" name="enddate" id="inputName" placeholder="Event Date"  required min="<?php echo date("Y-m-d"); ?>">
                  </div>
                </div>
                <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Place/Location</label>

                <div class="col-sm-10">
                    <select name="txtcountry" class="text form-control">
                    <?php include 'country.txt'?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputProfileImage" class="col-sm-2 control-label">Event Picture</label>

                  <div class="col-sm-10">
                    <input type="file" id="file" name="image" class="form-control" required>
                    <input type="hidden" id="hiddenpicture" name="hiddenpicture">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="btnadd" class="btn btn-info"><i class="fa fa-plus"></i> &nbsp;&nbsp; Create Event</button>
                  </div>
                </div>
                </form>
                  
            </div>
        </div>
		
		<script>
		var dateToday = new Date();
		var dates = $("#from, #to").datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 3,
			minDate: dateToday,
			onSelect: function(selectedDate) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $(this).data("datepicker"),
					date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
		</script>
  

        <div class="tab-pane" id="abandon">
        <!-- form start -->
        <div class="box-header with-border">
        <h6>Those event that is deleted by the event organizer and doen't confirmed by the Admin</h6>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                <table class="table table-bordered" id="table2">
                            <th>Events ID</th>
							<th>Event Organizer</th>
							<th>Title</th>
							<th>Event Bio</th>
							<th>Description</th>
<?php
                $query = mysqli_query($conn, "select * from boss_event where id_user='$_SESSION[id_user]' and status='Abandoned'");
                  while($result = mysqli_fetch_array($query)){
                    $id=$result['id_event'];
                    $title=$result['title'];
                    $eventbio=$result['eventbio'];
                    $description=$result['description'];
                    $start_date=$result['start_date'];
                    $end_date=$result['end_date'];
                    $place=$result['place'];
                    $picture=$result['picture'];
                    $query1 = mysqli_query($conn, "select * from users where id_user='$_SESSION[id_user]'");
                    if($result1 = mysqli_fetch_array($query1)){
                      $name=$result1['name'];
                      echo'
                      <tr>
                     <td>'.$id.'</td>
                     <td>'.$name.'</td>
                     <td>'.$title.'</td>
                     <td>'.$eventbio.'</td>
                     <td>'.$description.'</td>
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
                        <button type="submit" name="recycledbtn" class="btn btn-info"><i class="fa fa-recycle"></i>&nbsp;&nbsp;Recycle</button>
						<button type="submit" name="view_abandoned" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</button>
						<button type="submit" name="deletebtn" class="btn btn-info"><i class="fa fa-trash"></i>&nbsp;&nbsp;Delete Permanently</button>
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
		<div class="tab-pane" id="pending">
        <!-- form start -->
        <div class="box-header with-border">
        <h6 >If Status is "Pending" you need to publish the event.</h6>
        <h6 >If Status is "Waiting" then your published event wait for the confirmation of Admin.</h6>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <div class="col-sm-12">
                    <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                  
                    <table class="table table-bordered" id="table_pending">
                        <th>Events ID</th>
                        <th>Event Organizer</th>
                        <th>Title</th>
                        <th>Event Bio</th>
                        <th>Description</th>
                        <th>Status</th>
                        <?php
                $query = mysqli_query($conn, "select * from boss_event where id_user='$_SESSION[id_user]' and status='Pending' or status ='Paid'");
                  while($result = mysqli_fetch_array($query)){
                    $id=$result['id_event'];
                    $title=$result['title'];
                    $eventbio=$result['eventbio'];
                    $description=$result['description'];
                    $start_date=$result['start_date'];
                    $end_date=$result['end_date'];
                    $place=$result['place'];
                    $picture=$result['picture'];
                    $status=$result['status'];
                    $query1 = mysqli_query($conn, "select * from users where id_user='$_SESSION[id_user]'");
                    if($result1 = mysqli_fetch_array($query1)){
                      $name=$result1['name'];
                      echo'
                      <tr>
                     <td>'.$id.'</td>
                     <td>'.$name.'</td>
                     <td>'.$title.'</td>
                     <td>'.$eventbio.'</td>
                     <td>'.$description.'</td>
					
					';
					 if($status =='Paid'){
						   echo '<td>Waiting</td>';
					 }else{
							echo ' <td>'.$status.'</td>';
					}
					
					 
                   
				   
                echo '</tr>
			';
			}
		}
?>

                            
                        </table>
                        <input type="hidden"  id="rid" name="rid">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <div class="pull-right margin-r-5">
					<label class="btn btn-info" data-toggle="modal" data-target="#myModal_addpayment"><i class="fa fa-address-card-o"></i> &nbsp;&nbsp;Publish </label>
					<button type="submit" name="view_event_btn" class="btn btn-info">  <i class="fa fa-eye"></i> &nbsp;&nbsp; View</button>
					<button type="submit" name="btnedit" class="btn btn-info">  <i class="fa fa-edit"></i> &nbsp;&nbsp; Edit</button>
                    <button type="submit" name="delete" class="btn btn-info"><i class="fa fa-trash" ></i>&nbsp;&nbsp;Abandon</button>
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
		 <!-- ADD PAYMENT MODAL --> 
        <!-- Modal -->
        <div id="myModal_addpayment" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Do you want to publish your event?</h4>
                </div>
                <div class="modal-body" align="center">
                  <p>Publishing Event Cost £50 .</p>
                  <input type="checkbox" value="Terms and Conditions"> <a href="../Welcome to Boss Cars UK.pdf" target="_blank">Terms and Conditions</a>
              
				 <br>
                  <br>

                  <!-- CODE FOR PAYPAL BUTTON -->
                  <div style="display:block; margin-rigth:auto; margin-left:auto;">
                   <div id="paypal-button"></div>
                  </div>
           
                  <!-- CODE FOR PAYPAL BUTTON END-->        
          
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>
		  
				  
		<?php
		if(isset($_POST['view_event_btn'])){
			$rid = $_POST['rid'];
			echo "<script>window.location.href='view_event.php?id=$rid';</script>";
		}
		if(isset($_POST['view_abandoned'])){
			$id_abandoned = $_POST['id_abandoned'];
			echo "<script>window.location.href='view_event.php?id=$id_abandoned';</script>";
		}
		
		if(isset($_POST['recycledbtn'])){
			$id_abandoned = $_POST['id_abandoned'];
			mysqli_query($conn,"update boss_event set status='Pending' where id_event='$id_abandoned'");
			echo "<script>window.location.href='organizer_boss_cars_event.php';</script>";
		}
		if(isset($_POST['deletebtn'])){
			$id_abandoned = $_POST['id_abandoned'];
			mysqli_query($conn,"delete from boss_event where id_event='$id_abandoned'");
			echo "<script>window.location.href='organizer_boss_cars_event.php';</script>";
		}
		if(isset($_POST['viewheld'])){
			$id_held = $_POST['id_held'];
			echo "<script>window.location.href='view_event.php?id=$id_held';</script>";
		}
			if(isset($_POST['view_ongoing'])){
			$rid_ongoing = $_POST['rid_ongoing'];
			echo "<script>window.location.href='view_event.php?id=$rid_ongoing';</script>";
		}
		?>
<!--End Of Pending-->
		<div class="tab-pane" id="ongoing">
        <!-- form start -->
        <div class="box-header with-border">
        <h6 >List of your ongoing events that is published and confirmed by the Admin.</h6>
        </div>
        <form class="form-horizontal" method="post" target="blank" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <div class="col-sm-12">
                    <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                  
                    <table class="table table-bordered" id="table_ongoing">
                        <th>Events ID</th>
                        <th>Event Organizer</th>
                        <th>Title</th>
                        <th>Event Bio</th>
                        <th>Description</th>
                        <?php
                  $query = mysqli_query($conn, "select * from boss_event where id_user='$_SESSION[id_user]' and status='Ongoing'");
                  while($result = mysqli_fetch_array($query)){
                    $id=$result['id_event'];
                    $title=$result['title'];
                    $eventbio=$result['eventbio'];
                    $description=$result['description'];
                    $start_date=$result['start_date'];
                    $end_date=$result['end_date'];
                    $place=$result['place'];
                    $picture=$result['picture'];
                    $query1 = mysqli_query($conn, "select * from users where id_user='$_SESSION[id_user]'");
                    if($result1 = mysqli_fetch_array($query1)){
                      $name=$result1['name'];
                      echo'
                      <tr>
                     <td>'.$id.'</td>
                     <td>'.$name.'</td>
                     <td>'.$title.'</td>
                     <td>'.$eventbio.'</td>
                     <td>'.$description.'</td>
                </tr>
			';
			}
		}
?>

                            
                        </table>
                        <input type="hidden" id="rid_ongoing" name="rid_ongoing">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <div class="pull-right margin-r-5">
                                       
                       <button type="submit" name="view_ongoing" class="btn btn-info"><i class="fa fa-eye"></i> &nbsp;&nbsp; View</button>

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
<!--End Of Ongoing-->
        
      
     


        <div class="tab-pane" id="held">
        <!-- form start -->
        <div class="box-header with-border">
        <h6 >List of event that is ended in given time Duration.</h6>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                        <table class="table table-bordered" id="table1">
                            <th>Events ID</th>
							<th>Event Organizer</th>
							<th>Title</th>
							<th>Event Bio</th>
							<th>Description</th>
                                                  <?php
                $query = mysqli_query($conn, "select * from boss_event where id_user='$_SESSION[id_user]' and status='Held'");
                  while($result = mysqli_fetch_array($query)){
                    $id=$result['id_event'];
                    $title=$result['title'];
                    $eventbio=$result['eventbio'];
                    $description=$result['description'];
                    $start_date=$result['start_date'];
                    $end_date=$result['end_date'];
                    $place=$result['place'];
                    $picture=$result['picture'];
                    $query1 = mysqli_query($conn, "select * from users where id_user='$_SESSION[id_user]'");
                    if($result1 = mysqli_fetch_array($query1)){
                      $name=$result1['name'];
                      echo'
                      <tr>
                     <td>'.$id.'</td>
                     <td>'.$name.'</td>
                     <td>'.$title.'</td>
                     <td>'.$eventbio.'</td>
                     <td>'.$description.'</td>
                </tr>
			';
			}
		}
?>
                        </table>
						<input type="hidden" id="id_held" name="id_held">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <button type="submit" name="viewheld" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp; View </button>
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
<!--For Upload Events-->
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
			document.getElementById("hiddenpicture").value="uploads/uploadevents/<?php echo date('ljS\ofFY');?>"+a[2];
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
				url:"upload_img_of_events.php",
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
	 if(isset($_POST['btnadd'])){
		$title = $_POST["txttitle"];
		$eventbio = $_POST["txteventbio"];
		$description = $_POST["txtdescription"];
		$startdate = $_POST["startdate"];
		$enddate = $_POST["enddate"];
		$txtcountry = $_POST["txtcountry"];
		$picture = $_POST["hiddenpicture"];
    
    //get date duration
    $datetime1 = new DateTime($start_date);
    $datetime2 = new DateTime($end_date);
    $interval = $datetime1->diff($datetime2);
    $event_duration =  $interval->format('%R%a days');

    mysqli_query($conn,"insert into boss_event values('','$_SESSION[id_user]','$title','$eventbio','$description','$startdate','$enddate','$event_duration','$txtcountry','$picture','Pending')");

							echo '<script language="javascript">';
							echo 'alert("Your Events Details Succesfully Saved")';
              echo '</script>';
              
              echo '<script>window.location.href="organizer_boss_cars_event.php"</script>';
   }
   if(isset($_POST['delete'])){
     $rid = $_POST['rid'];
     mysqli_query($conn,"update boss_event set status='Abandoned' where id_event='$rid'");
     echo '<script language="javascript">';
     echo 'alert("Event Abandoned")';
     echo '</script>';

     echo '<script>window.location.href="organizer_boss_cars_event.php"</script>';
   }
?>
</body>
</html>
<script>
function tableToExcel(table, name, filename) {
        let uri = 'data:application/vnd.ms-excel;base64,', 
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><title></title><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--><meta http-equiv="content-type" content="text/plain; charset=UTF-8"/></head><body><table>{table}</table></body></html>', 
        base64 = function(s) { return window.btoa(decodeURIComponent(encodeURIComponent(s))) },         format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; })}
        
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

        var link = document.createElement('a');
        link.download = filename;
        link.href = uri + base64(format(template, ctx));
        link.click();
}
</script>

<script>
          
    function selectedRow(){
        
        var index,
            table = document.getElementById("table_pending");
    
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
					  document.getElementById("id_held").value = this.cells[0].innerHTML;
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
                  table = document.getElementById("table2");
          
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

					   document.getElementById("id_abandoned").value = this.cells[0].innerHTML;
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
                      
                      index = this.rowIndex;
                      // add class selected to the row
					  
					     document.getElementById("rid_ongoing").value = this.cells[0].innerHTML;

                      this.classList.toggle("selected");
                      // Get the value for the selected row
                    
      
                      console.log(typeof index);
      
                  
                    };
              }
              
          }
          selectedRow();
      
      </script>
	  	  <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'ARyzAmTW0oqZpXZemE7poVhu4f_R-FmTSIi4MjAkCzCqAg2vGC3eyxADq2XLowRtKkrHSmimx1cmi4hO',
                production: 'AWAJz3eA62xzvRT2hD0mk5UW6MW0rUJXwcKZ3kUkRokpWXzld37RQRYrcp7oI-JJC0Tya0NJNhZy2S19'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '5', currency: 'EUR' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                  
					window.alert('Payment Complete!');
					
					var x = document.getElementById("rid").value;
					
					window.location.href='update_pending.php?id='+ x;
         

					//window.close();

                });
            }


        }, '#paypal-button');

    </script>

