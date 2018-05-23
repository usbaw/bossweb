<?php

$servername = "localhost";
$username = "jerojoar_social";
$password = "password2018";
$dbname = "jerojoar_boss_db";

//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error) {
	die("Connection Failed: " . $conn->connect_error);
}