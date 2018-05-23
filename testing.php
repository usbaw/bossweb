<?php
include 'db.php';
$data=mysqli_query($conn,"select * from boss_event limit 2");
while($result=mysqli_fetch_array($data)){
echo $result['id_user']."<br>";
echo $result['title']."<br>";
echo $result['eventbio']."<br>";
echo $result['description']."<br>";
echo $result['start_date']."<br>";
echo $result['end_date']."<br><br>";
}

?>
