<?php
include 'db.php';
$id= $_GET["id"];
	mysqli_query($conn,"update boss_event set status='Ongoing' where id_event='$id'");
	header("Location:admin_boss_cars_event.php");
	
?>
