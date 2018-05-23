<?php

session_start();

require_once("db.php");

if(isset($_POST)) {

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$security = mysqli_real_escape_string($conn, $_POST['security']);
	$sec_ans = mysqli_real_escape_string($conn, $_POST['sec_ans']);
	$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

	$password = base64_encode(strrev(md5($password)));

	if($user_type == 'User'){
		$sql = "INSERT INTO users(name, email, password, security_question, security_answer) VALUES ('$name', '$email', '$password','$security','$sec_ans')";
	
	}else{
		$sql = "INSERT INTO users(name, email, password, security_question, security_answer,user_type) VALUES ('$name', '$email', '$password','$security','$sec_ans','2')";
	}

			//update the user type status of new account
			//0 for admin
			//1 for user
			//2 for event organizer

	if($conn->query($sql)===TRUE) {
		$_SESSION['registeredSuccessfully'] = true;
			echo "ok";
			
			

	
		
	} else {
		echo "error";
	}
	
	
	

	
}