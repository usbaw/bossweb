<?php 
session_start();

include 'db.php';

     $sql1 = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
                $result1 = $conn->query($sql1);
	
                while($row = $result1->fetch_assoc()) {
				$ban_reason = $row['ban_reason'];
				
				}
				
	if(isset($_POST['continue'])){
		$email =$_POST['email'];
		$result= mysqli_query($conn,"select * from users where email='$email'");
		$row  = mysqli_num_rows($result);
		if($row>0){
			echo "<script>window.location.href='forgot2.php?email=$email'</script>";
		}else{
			echo'<script>alert("Incorrect Email");</script>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Boss Cars | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <!-- Custom -->
  <link rel="stylesheet" href="dist/css/custom.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url('images/maxresdefault.jpg'); background-position:center; background-size:cover; background-repeat:no-repeat; height:80vh;">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b><font color="white">Boss </b>Cars</font></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign In</p>

    <form  method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
  
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="submit" name="continue" value="Continue" style="margin-left:120px; width:100;" class="btn btn-primary btn-block btn-flat" >
          
        </div>
        <!-- /.col -->
      </div>
    
    
    </form>
    <!-- /.social-auth-links -->
    <div align="center">
    <a href="login.php" class="text-center">Back to login form</a>
    </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

</body>
</html>
