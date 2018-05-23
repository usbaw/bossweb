<!DOCTYPE html>
<html lang="en">
<head>
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<title>Boss Cars</title>
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/normalize.css" rel="stylesheet" type="text/css">
    <link href="css/demo.css" rel="stylesheet" type="text/css">
	<link href="css/xopixel.css" rel="stylesheet" type="text/css">
	
	<!-- LIGHT BOX -->
    <link rel="stylesheet" href="css/lightbox.min.css">
    <script type="text/javascript" src="js/lightbox-plus-jquery.min.js"></script>
</head>
<body bgcolor="black">
	<header class="xopixel-header">
		<nav>
			<a class="xopixel-back" href="../index.php" title="Back to Home Page"></a> <a class="xopixel-archive" href="../boss-back/login.php" title="Sign Up to see more updates on event"></a>
		</nav>
		<h1>Business Banners</h1>
    </header>    
    
	<div class="xop-section">
		<ul class="xop-grid">
		
		    <?php
			require_once("../db.php");

					//  $sql = "SELECT * FROM ( SELECT post.id_post, post.image, post.createdAt FROM post INNER JOIN users ON post.id_user=users.id_user WHERE post.id_user='$_SESSION[id_user]' AND post.image!='' UNION SELECT friend_posts.id_post, friend_posts.image, friend_posts.createdAt FROM friend_posts INNER JOIN users ON friend_posts.id_user=users.id_user WHERE friend_posts.id_friend='$_SESSION[id_user]' AND friend_posts.image!='') posts ORDER BY posts.createdAt DESC";

					$sql = "select * from flyers_or_advertisement where status='Ongoing'";

						$result = $conn->query($sql);

						if($result->num_rows > 0) {
						  $totalDiv  = (int) ceil($result->num_rows / 5);
			?>
			<?php while($row = $result->fetch_assoc()) { ?>

					<li>
						<div class="xop-box" style="background:linear-gradient(rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.10)),/* bottom, image */url(../boss-back/<?php echo $row['picture']; ?>); background-position:center; background-size:cover; background-repeat:no-repeat;">
							
							<div class="xop-info" align="center">
								<h3 ><?php echo $row['caption']; ?></h3>
								<p></p>
							</div>
						</div>
					</a></li>
				   
			<?php
			}
			?>
			<?php }  ?>
	
		</ul>
	</div>

</body>
</html>
