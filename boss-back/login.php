<?php 
session_start();

include 'db.php';

     $sql1 = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
                $result1 = $conn->query($sql1);
	
                while($row = $result1->fetch_assoc()) {
				$ban_reason = $row['ban_reason'];
				
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

    <form id="loginForm" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" 
          +>Sign In</button>          
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-xs-12">
            <span id="loginError" class="color-red hide-me">Invalid Email/Password!</span>
            <span id="ban" class="color-red hide-me">Your account is temporarily ban!<br></span>
            <span id="ban_reason" class="color-red hide-me">Reason: &nbsp; <?php echo $ban_reason;?></span>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <?php if(isset($_SESSION['registeredSuccessfully'])) { ?>
            <span id="registeredSuccessfully" class="color-green">You Have Registered Successfully!</span>
          <?php unset($_SESSION['registeredSuccessfully']); } ?>
        </div>
      </div>
    </form>
    <!-- /.social-auth-links -->
    <div align="center">
    <a href="forgot1.php">I forgot my password</a><br>
    <a href="register.php" class="text-center">Create an account</a>
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
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<!-- Custom -->
<script>
  $(function() {
    $("#registeredSuccessfully:visible").fadeOut(8000);
  });
</script>
<!-- 

IF 0 USER
IF 1 ADMIN
IF 2 EVENT ORGANIZER
IF 3 BAN USER

 -->
<script>

  $("#loginForm").on("submit", function(e) {
    e.preventDefault();
    $.post("checklogin.php", $(this).serialize() ).done(function(data) {
        var result = $.trim(data);
        if(result == "1") {
          window.location.href = "admin_boss_cars_event.php";
        } else  if(result == "0") {
          window.location.href = "index.php";
        } else  if(result == "2") {
          window.location.href = "organizer_index.php";
        } 
		else  if(result == "3") {
           $("#ban").show();
           $("#ban_reason").show();
        }
		else
        {
          $("#loginError").show();
        }
      });
  });
</script>
</body>
</html>
