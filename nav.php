
<?php

if(empty($_SESSION['id_user'])) {
 
    echo '
    
		<nav class="navbar navbar-light navbar-expand-md">
            <div class="container-fluid"><a class="navbar-brand" href="boss-back/login.php" style="color:rgba(0,0,0,0.9);">&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp; Login &nbsp;&nbsp;</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                    class="collapse navbar-collapse" id="navcol-2">
                    <ul class="nav navbar-nav mx-auto">
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="index.php" style="color:rgba(0,0,0,0.9);"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="BossEvent/index.php?id="all"" style="color:rgba(0,0,0,0.9);"><i class="fa fa-play"></i>&nbsp;Boss Events</a></li>
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="boss-back/login.php" style="color:rgba(0,0,0,0.9);"><i class="fa fa-calendar"></i>&nbsp;Newsfeed</a></li>
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="#" style="color:rgba(0,0,0,0.9);"><i class="fa fa-shopping-cart"></i>&nbsp;Shop</a></li>
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="BossEvent/gallery.php" style="color:rgba(0,0,0,0.9);"><i class="fa fa-image"></i>&nbsp;Admin Gallery</a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="index.php"><img src="assets/img/logo.png" id="boss-logo-logo"></a></li>
                    </ul>
            </div>
            </div>
        </nav>

    ';

}else{
    echo '
    
    <nav class="navbar navbar-light navbar-expand-md">
	
	    '; ?>
         <?php 
             if($_SESSION["user_type"] == "0"){
                echo '<div class="container-fluid"><a class="navbar-brand" href="boss-back/index.php" style="color:rgba(0,0,0,0.9);">&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp; My Account &nbsp;&nbsp;</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>';
            }else if($_SESSION["user_type"] == "2"){
                echo '<div class="container-fluid"><a class="navbar-brand" href="boss-back/organizer_index.php" style="color:rgba(0,0,0,0.9);">&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp; My Account &nbsp;&nbsp;</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>';
            }else{
                echo '<div class="container-fluid"><a class="navbar-brand" href="boss-back/admin_index.php" style="color:rgba(0,0,0,0.9);">&nbsp;&nbsp;<i class="fa fa-user"></i>&nbsp; My Account &nbsp;&nbsp;</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-2"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>';
            }
          
        
            echo '
			
            
                <div
                    class="collapse navbar-collapse" id="navcol-2">
                    <ul class="nav navbar-nav mx-auto">
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="index.php" style="color:rgba(0,0,0,0.9);"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="BossEvent/index.php" style="color:rgba(0,0,0,0.9);"><i class="fa fa-play"></i>&nbsp;Boss Events</a></li>
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="boss-back/login.php" style="color:rgba(0,0,0,0.9);"><i class="fa fa-calendar"></i>&nbsp;Newsfeed</a></li>
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="#" style="color:rgba(0,0,0,0.9);"><i class="fa fa-shopping-cart"></i>&nbsp;Shop</a></li>
                        <li class="nav-item nav-hover" role="presentation"><a class="nav-link active" href="BossEvent/gallery.php" style="color:rgba(0,0,0,0.9);"><i class="fa fa-image"></i>&nbsp;Admin Gallery</a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="index.php"><img src="assets/img/logo.png" id="boss-logo-logo"></a></li>
                    </ul>
            </div>
            </div>
        </nav>

            </ul>
           

         </div>
    </div>
    </nav>
    ';
    
}

?>



           