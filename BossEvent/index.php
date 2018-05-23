<?php
$id=$_GET["id"]; 
?>
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
</head>
<body bgcolor="black">
<?php 
$id=$_GET["id"];

$hi = 'x';
include '../db.php';
$datetoday=date("Y-m-d");
?>
	<header class="xopixel-header">
		<nav>
			<a class="xopixel-back" href="../index.php" title="Back to Home Page"></a> <a class="xopixel-archive" href="../boss-back/login.php" title="Sign Up to see more updates on event"></a>
		</nav>
		<h1>Boss Cars Event Compilation <?php echo $id?></h1>
    </header>    
    
	<div class="xop-section">
		<ul class="xop-grid">
		
<?php

   // $query = mysqli_query($conn, "select * from boss_event where status='Ongoing'");
    $query = mysqli_query($conn, "SELECT * FROM boss_event WHERE status='Ongoings' LIMIT 3;");
    while($result = mysqli_fetch_array($query)){
					$id_event=$result['id_event'];
					$id_user=$result['id_user'];
                    $title=$result['title'];
                    $eventbio=$result['eventbio'];
                    $description=$result['description'];
                    $start_date=$result['start_date'];
                    $end_date=$result['end_date'];
                    $place=$result['place'];
                    $picture=$result['picture'];
            $query1 = mysqli_query($conn, "select * from users where id_user='$id_user' TOP 2 ");
			if($result1 = mysqli_fetch_array($query1)){
			$name=$result1['name'];
			}
			echo'
				<li>
				<div class="xop-box" style="background:linear-gradient(rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.10)),/* bottom, image */url(../boss-back/'.$picture.');background-position:center; background-size:cover; background-repeat:no-repeat;" title="Click The Events To View">
					<a href="../boss-back/login.php">
					<div class="xop-info">
						<h3>'.$title.'</h3>
						<p>'.$eventbio.'</p><br>
						<p>Uploded By:'.$name.'</p>
					</div></a>
				</div>
			</li>
			';
		}	



if ($id=="TOP"){
    $query = mysqli_query($conn, "SELECT * FROM boss_event WHERE status='Ongoing' LIMIT 3;");
    while($result = mysqli_fetch_array($query)){
					$id_event=$result['id_event'];
					$id_user=$result['id_user'];
                    $title=$result['title'];
                    $eventbio=$result['eventbio'];
                    $description=$result['description'];
                    $start_date=$result['start_date'];
                    $end_date=$result['end_date'];
                    $place=$result['place'];
                    $picture=$result['picture'];
            $query1 = mysqli_query($conn, "select * from users where id_user='$id_user'");
			if($result1 = mysqli_fetch_array($query1)){
			$name=$result1['name'];
			}
			echo'
				<li>
				<div class="xop-box" style="background:linear-gradient(rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.10)),/* bottom, image */url(../boss-back/'.$picture.'); background-position:center; background-size:cover; background-repeat:no-repeat;" title="Click The Events To View">
					<a href="../boss-back/login.php">
					<div class="xop-info">
						<h3>'.$title.'</h3>
						<p>'.$eventbio.'</p><br>
						<p>Uploded By:'.$name.'</p>
					</div></a>
				</div>
			</li>
			';
		}	
}
else if($id=="NEW"){
	$query = mysqli_query($conn, "select * from boss_event where status='Ongoing' start_date>='$datetoday' order by start_date asc ");
    while($result = mysqli_fetch_array($query)){
					$id_event=$result['id_event'];
					$id_user=$result['id_user'];
                    $title=$result['title'];
                    $eventbio=$result['eventbio'];
                    $description=$result['description'];
                    $start_date=$result['start_date'];
                    $end_date=$result['end_date'];
                    $place=$result['place'];
                    $picture=$result['picture'];
                    $query1 = mysqli_query($conn, "select * from users where id_user='$id_user'");
                    if($result1 = mysqli_fetch_array($query1)){
                      $name=$result1['name'];
			}
			echo'
				<li>
				<div class="xop-box" style="background:linear-gradient(rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.10)),/* bottom, image */url(../boss-back/'.$picture.');" title="Click The Events To View">
					<a href="../boss-back/login.php">
					<div class="xop-info">
						<h3>'.$title.'</h3>
						<p>'.$eventbio.'</p><br>
						<p>Uploded By:'.$name.'</p>
					</div></a>
				</div>
			</li>
			';
		}
}
else if($id=="UP"){
	$query = mysqli_query($conn, "select * from boss_event where status='Paid' order by start_date asc ");
    while($result = mysqli_fetch_array($query)){
					$id_event=$result['id_event'];
					$id_user=$result['id_user'];
                    $title=$result['title'];
                    $eventbio=$result['eventbio'];
                    $description=$result['description'];
                    $start_date=$result['start_date'];
                    $end_date=$result['end_date'];
                    $place=$result['place'];
                    $picture=$result['picture'];
                    $query1 = mysqli_query($conn, "select * from users where id_user='$id_user'");
                    if($result1 = mysqli_fetch_array($query1)){
                      $name=$result1['name'];
			}
			echo'
				<li>
				<div class="xop-box" style="background:linear-gradient(rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.10)),/* bottom, image */url(../boss-back/'.$picture.');" title="Click The Events To View">
					<a href="../boss-back/login.php">
					<div class="xop-info">
						<h3>'.$title.'</h3>
						<p>'.$eventbio.'</p><br>
						<p>Uploded By:'.$name.'</p>
					</div></a>
				</div>
			</li>
			';
		}
}
else if($id=="all"){
	$query = mysqli_query($conn, "select * from boss_event where status='Ongoing' order by start_date asc ");
    while($result = mysqli_fetch_array($query)){
					$id_event=$result['id_event'];
					$id_user=$result['id_user'];
                    $title=$result['title'];
                    $eventbio=$result['eventbio'];
                    $description=$result['description'];
                    $start_date=$result['start_date'];
                    $end_date=$result['end_date'];
                    $place=$result['place'];
                    $picture=$result['picture'];
                    $query1 = mysqli_query($conn, "select * from users where id_user='$id_user'");
                    if($result1 = mysqli_fetch_array($query1)){
                      $name=$result1['name'];
			}
			echo'
				<li>
				<div class="xop-box" style="background:linear-gradient(rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.10)),/* bottom, image */url(../boss-back/'.$picture.');" title="Click The Events To View">
					<a href="../boss-back/login.php">
					<div class="xop-info">
						<h3>'.$title.'</h3>
						<p>'.$eventbio.'</p><br>
						<p>Uploded By:'.$name.'</p>
					</div></a>
				</div>
			</li>
			';
		}
}
?>
		</ul>
	</div>

</body>
</html>
