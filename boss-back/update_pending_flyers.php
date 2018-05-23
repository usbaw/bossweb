<?php
include 'db.php';
$id= $_GET["id"];
	mysqli_query($conn,"update flyers_or_advertisement set status='Paid' where id='$id'");
	header("Location:organizer_flyers_advertisement.php");
?>
	