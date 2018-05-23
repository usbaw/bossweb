<?php
require_once("db.php");
$event_id = $_GET['event_id'];
mysqli_query($conn,"update boss_event set status='Paid' where id_event='2'");
?>