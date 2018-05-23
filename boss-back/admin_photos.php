<?php

session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: login.php");
  exit();
}

require_once("db.php");

$name = $designation ="";

$sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
$result = $conn->query($sql);

if($result->num_rows > 0) { 
  while($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $designation = $row['designation'];
  }
}

$_SESSION['callFrom'] = "admin_photos.php";

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Gallery</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <link rel="stylesheet" href="../assets/css/boss-gallery.css">
    <link rel="stylesheet" href="../assets/css/lightbox.min.css">
    <script type="text/javascript" src="../assets/js/lightbox-plus-jquery.min.js"></script>

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
.gallery{
    margin:10px 50px;
}
.gallery img{
    width: 170px;
    padding: 5px;
    filter:grayscale(50%);
    transition: 1s;

}
.gallery img:hover{
    filter:grayscale(0%);
    transform:scale(1.1);
}
</style>
<body class="hold-transition skin-blue sidebar-mini">


<?php
require_once("db.php");

if(isset($_POST['upload'])){
  $caption = $_POST['caption'];
  $hiddenpicture = $_POST['hiddenpicture'];

  $today = date("F j, Y, g:i a");  

  mysqli_query($conn,"insert into admin_gallery values('','$hiddenpicture','$caption','$today','$_SESSION[id_user]')");


}
?>

<div class="wrapper">

    <!-- Header -->
  <?php include_once("header.php"); ?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php include_once("admin_sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <!-- ADD PHOTOS MODAL START -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Picture</h4>
        </div>
        <div class="modal-body">
          <p>This photo will appear in the website under of  admin gallery.</p>
          <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inputSkills" class="col-sm-2 control-label">Caption</label>

                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="caption" id="caption" placeholder="Event Title"  required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputProfileImage" class="col-sm-2 control-label">Image</label>

                  <div class="col-sm-10">
                    <input type="file" id="file" name="image" class="form-control" required>
                    <input type="hidden" id="hiddenpicture" name="hiddenpicture">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="upload" class="btn btn-danger">Upload Image</button>
                  </div>
                </div>
          </form>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- ADD PHOTOS MODAL END -->



  <section class="content-header">
      <h1>
        Admin Gallery
      </h1>
      <div align="right" style="display:block; margin-top:-28px; margin-bottom:30px;">
    <label for="add_photos" data-toggle="modal" data-target="#myModal" class="btn-primary" style="padding:10px; border-radius:5px;text-align:center; border:1px solid white; width:140px;"><i class="fa fa-plus"></i> &nbsp;&nbsp;&nbsp; Add Photos</label>
      </div>
     
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-12">

        <?php

            //  $sql = "SELECT * FROM ( SELECT post.id_post, post.image, post.createdAt FROM post INNER JOIN users ON post.id_user=users.id_user WHERE post.id_user='$_SESSION[id_user]' AND post.image!='' UNION SELECT friend_posts.id_post, friend_posts.image, friend_posts.createdAt FROM friend_posts INNER JOIN users ON friend_posts.id_user=users.id_user WHERE friend_posts.id_friend='$_SESSION[id_user]' AND friend_posts.image!='') posts ORDER BY posts.createdAt DESC";

            $sql = "select * from admin_gallery where id_user='$_SESSION[id_user]'";

                $result = $conn->query($sql);

                if($result->num_rows > 0) {
                  $totalDiv  = (int) ceil($result->num_rows / 5);
                  ?>
          <!-- Post -->
          <div class="post">
            <!-- /.user-block -->
            <div class="row margin-bottom">
              <!-- /.col -->
              <div class="col-sm-12">
                <div class="row">
                  <?php while($row = $result->fetch_assoc()) { ?>

                  <div class="gallery" style="float:left;">
                  
                  <a href="<?php echo $row['image']; ?>" data-lightbox="mygallery"  data-title="<?php echo $row['caption']?>"> <img src="<?php echo $row['image']; ?>" alt="Photo"> </a>
                 
                  </div>
                  <?php
                    }
                  ?>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.col -->
            </div>
          </div>
          <!-- /.post -->

          <?php }  ?>

        </div>
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
</body>
</html>

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
			document.getElementById("hiddenpicture").value="uploads/admin_gallery/<?php echo date('ljS\ofFY');?>"+a[2];
        }
    }
		var property = document.getElementById('file').files[0];
		var image_name = property.name;
		var image_extension = image_name.split('.').pop().toLowerCase();
		if(jQuery.inArray(image_extension, ['gif','jpeg','jpg','png']) == -1 ){
			alert ('Invalid Image File');
		}
		var image_size = property.size;
		if(image_size > 10000000){
			alert ('Image File is Too Big');
		}
		else{
			var form_data = new FormData();
			form_data.append("file", property);
			$.ajax({
				url:"upload_admin_gallery.php",
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


