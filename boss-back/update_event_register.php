<?php
include 'db.php';
session_start();
$id= $_GET["id"];
	mysqli_query($conn,"insert into event_register values('','$_SESSION[id_event]','$_SESSION[id_user]','')");
	header("Location:user_boss_cars_event_registration.php?id=$id");
?>
