<?php
include 'db.php';
$id= $_GET["id"];
	mysqli_query($conn,"update flyers_or_advertisement set status='Ongoing' where id='$id'");
	header("Location:admin_flyer_advertisement.php");
	
?>
