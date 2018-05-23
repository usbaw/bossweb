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
  <title>Boss Cars</title>
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

  <!-- STYLE FOR BOOTSTRAP MODAL
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- PAYPAL LINK -->
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
              <li class="active"><a href="#Create" data-toggle="tab">Create Ads</a></li>
              <!-- <li><a href="#timeline" data-toggle="tab">Timeline</a></li> -->
              <li><a href="#pending" data-toggle="tab">My Pending Ads</a></li>
              <li><a href="#Ongoing" data-toggle="tab">Ongoing Ads</a></li>
              <li><a href="#held" data-toggle="tab">Held Ads</a></li>
              <li><a href="#abandon " data-toggle="tab">Abandoned Ads</a></li>
            </ul>
<!--For Create Events-->
<?php
	 if(isset($_POST['submit'])){
		$title = $_POST["txttitle"];
		$caption = $_POST["txtcaption"];
		$description = $_POST["txtdescription"];
		$picture = $_POST["hiddenfirstphotopath"];
		
		mysqli_query($conn,"INSERT INTO flyers_or_advertisement SET 
							id_user = '$_SESSION[id_user]', 
							title = '$title', 
							caption = '$caption', 
							description = '$description', 
							picture = '$picture', 
							status = 'Pending'");
							echo '<script language="javascript">';
							echo 'alert("Your Advertisement Details Succesfully Saved")';
							echo '</script>';
   }
  if(isset($_POST['btndelete'])){
    $rid = $_POST['rid'];
    mysqli_query($conn,"delete from flyers_or_advertisement where id='$rid'");
    echo '<script language="javascript">';
    echo 'alert("Succesfully Deleted")';
    echo '</script>';
  }
 

?>

            <div class="tab-content">
              <div class="active tab-pane" id="Create">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <h6 >Create Advertisement</h6>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form class="form-horizontal" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Ads Title</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="txttitle" id="inputName" placeholder="Advertisement Title"  required>
                  </div>
                </div>
      
                <div class="form-group">
                  <label for="inputSkills" class="col-sm-2 control-label">Ads Bio</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputSkills" name="txtcaption" placeholder="Advertisement caption"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAboutMe" class="col-sm-2 control-label">Ads Description</label>

                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputAboutMe" name="txtdescription" placeholder="Advertisement Description"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputProfileImage" class="col-sm-2 control-label">Ads Picture</label>

                  <div class="col-sm-10">
                    <input type="file" id="file" name="images" class="form-control" required>
					<input type="hidden" name="hiddenfirstphotopath" id="hiddenfirstphotopath">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info" name="submit" ><i class="fa fa-plus"></i> &nbsp;&nbsp;Create Advertisement</button>
                  </div>
                </div>
                </form>
                  
            </div>
        </div>

        <div class="tab-pane" id="abandon">
        <!-- form start -->
        <div class="box-header with-border">
        <h6>Those Ads that is deleted by the event organizer and doen't confirmed by the Admin</h6>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                         <table class="table table-bordered" id="table_abandoned">
					  <th>Advertisement ID</th>
					  <th>Advertisement Organizer</th>
					  <th>Title</th>
					  <th>Caption</th>
					  <th>Description</th>
							<?php
							  $query = mysqli_query($conn, "select * from flyers_or_advertisement where id_user='$_SESSION[id_user]' and status='Abandoned'");
								while($result = mysqli_fetch_array($query)){
								  $id=$result['id'];
								  $title=$result['title'];
								  $caption=$result['caption'];
								  $description=$result['description'];
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
												<td>'.$caption.'</td>
												<td>'.$description.'</td>
									
									</tr>
								';
								}
							}
					?>
							 
				  </table>
				  <input type="hidden" id="id_abandoned" name="id_abandoned">
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                 
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <button type="submit" name="view_abandoned" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Details  </button>
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
        <h6>If Status is "Pending" you need to publish the Ads.</h6>
        <h6>If Status is "Waiting" then your published Ads wait for the confirmation of Admin.</h6>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <div class="col-sm-12">
              <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
              <table class="table table-bordered" id="table">
                  <th>Advertisement ID</th>
                  <th>Advertisement Organizer</th>
                  <th>Title</th>
                  <th>Caption</th>
                  <th>Description</th>
                  <th>Status</th>
        <?php
          $query = mysqli_query($conn, "select * from flyers_or_advertisement where id_user='$_SESSION[id_user]' and status='Pending' or status='Paid'");
            while($result = mysqli_fetch_array($query)){
              $id=$result['id'];
              $title=$result['title'];
              $caption=$result['caption'];
              $description=$result['description'];
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
                            <td>'.$caption.'</td>
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
              <input type="hidden" id="rid" name="rid">
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
          
            <div class="pull-right margin-r-5">
            <label class="btn btn-info" data-toggle="modal" data-target="#myModal_addpayment"><i class="fa fa-address-card-o"></i> &nbsp;&nbsp;Publish </label>
            <button type="submit" name="view_pending" class="btn btn-info"><i class="fa fa-eye"></i> &nbsp;&nbsp; View </button>
            <button type="submit" class="btn btn-info" name="btnedit"><i class="fa fa-edit"></i> &nbsp;&nbsp;Edit</button>
            <button type="submit" class="btn btn-info" name="btndelete"><i class="fa fa-trash"></i> &nbsp;&nbsp;Trash</button>

            
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
		if(isset($_POST['view_pending'])){
			$rid = $_POST['rid'];
			echo "<script>window.location.href='view_ads.php?id=$rid';</script>";
		}
		
		if(isset($_POST['view_held'])){
			$id_held = $_POST['id_held'];
			echo "<script>window.location.href='view_ads.php?id=$id_held';</script>";
		}
		
		if(isset($_POST['view_abandoned'])){
			$id_abandoned = $_POST['id_abandoned'];
			echo "<script>window.location.href='view_ads.php?id=$id_abandoned';</script>";
		}
		
			if(isset($_POST['view_ongoing'])){
			$id_ongoing4 = $_POST['id_ongoing4'];
			echo "<script>window.location.href='view_ads.php?id=$id_ongoing4';</script>";
		}
	?>


    
        <!-- EVENTS VIEW ADVERTISEMENT MODAL -->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Pending Advertisement</h4>
              </div>
              <div class="modal-body">
              <input type="hidden" id="rid1">

              <div style="text-align:center;text-transform:uppercase;">
              <h3> <div id="title"></div> </h3>
              <h6> <div style="font-color:gray; text-align:center;" id="caption"></div></h6>   

              <?php echo "<img style='border:2px solid black; padding:2px; background-color:gray;width:260px;height:260px;display:block;margin-right:auto;margin-left:auto;margin-bottom:25px;'' src='$picture' >";?>      
                       
              <div style="text-align:left">      
              <div style="padding:20px; text-align:justify;line-height:20px;text-indent: 50px;" id="description"></div>
              </div>

              </div>
              </div>
              <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>
        <!-- EVENTS VIEW ADVERTISEMENT MODAL END-->     

         <!-- ADD PAYMENT MODAL --> 
        <!-- Modal -->
        <div id="myModal_addpayment" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Do you want to publish your ADS?</h4>
                </div>
                <div class="modal-body" align="center">
                  <p>Publishing Advertisement Cost £50 .</p>
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
		  
        <!-- ADD PAYMENT MODAL END --> 
		<div class="tab-pane" id="Ongoing">
        <!-- form start -->
        <div class="box-header with-border">
        <h6>List of your ongoing ads that is published and confirmed by the Admin.</h6>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                  <table class="table table-bordered" id="table_ongoing2">
                  <th>Advertisement ID</th>
                  <th>Advertisement Organizer</th>
                  <th>Title</th>
                  <th>Caption</th>
                  <th>Description</th>
						<?php
						  $query = mysqli_query($conn, "select * from flyers_or_advertisement where id_user='$_SESSION[id_user]' and status='Ongoing'");
							while($result = mysqli_fetch_array($query)){
							  $id=$result['id'];
							  $title=$result['title'];
							  $caption=$result['caption'];
							  $description=$result['description'];
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
											<td>'.$caption.'</td>
											<td>'.$description.'</td>
								
								</tr>
							';
							}
						}
				?>
                         
              </table>
              <input type="hidden" id="id_ongoing4" name="id_ongoing4">
              
                        </div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    
                      <div class="pull-right margin-r-5">
                       
                      </div>
                      <div class="pull-right margin-r-5">
                        <button input="submit" name="view_ongoing" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;&nbsp;View </button>
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
        <h6>List of Ads that is ended in given time Duration.</h6>
        </div>
        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="col-sm-12">
                        <p>Search: <input class="form-control" type="text" style="width:60%; border-radius:8px;" placeholder="Search events"> <p>
                        <table class="table table-bordered" id="table_held">
					  <th>Advertisement ID</th>
					  <th>Advertisement Organizer</th>
					  <th>Title</th>
					  <th>Caption</th>
					  <th>Description</th>
							<?php
							  $query = mysqli_query($conn, "select * from flyers_or_advertisement where id_user='$_SESSION[id_user]' and status='Held'");
								while($result = mysqli_fetch_array($query)){
								  $id=$result['id'];
								  $title=$result['title'];
								  $caption=$result['caption'];
								  $description=$result['description'];
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
												<td>'.$caption.'</td>
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
			document.getElementById("hiddenfirstphotopath").value="uploads/flyersoradvertisement/<?php echo date('ljS\ofFY');?>"+a[2];
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
				url:"upload_img_of_flyers.php",
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
                document.getElementById("rid1").value = this.cells[0].innerHTML;
               
                document.getElementById("title").innerHTML = this.cells[2].innerHTML;
                document.getElementById("caption").innerHTML = this.cells[3].innerHTML;
                document.getElementById("description").innerHTML = this.cells[4].innerHTML;
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
            table = document.getElementById("table_ongoing2");
    
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
                document.getElementById("id_ongoing4").value = this.cells[0].innerHTML;

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
                                amount: { total: '50', currency: 'EUR' }
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
					
					window.location='update_pending_flyers.php?id=' +x;
         



                });
            }


        }, '#paypal-button');

    </script>
