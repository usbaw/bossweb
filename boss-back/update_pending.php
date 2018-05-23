<?php
include 'db.php';
$id= $_GET["id"];
	mysqli_query($conn,"update boss_event set status='Paid' where id_event='$id'");
	header("Location:organizer_boss_cars_event.php?id=$id");
?>
