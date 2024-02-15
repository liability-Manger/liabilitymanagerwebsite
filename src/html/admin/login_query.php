<?php
	session_start();
	require 'conn.php';
	
	if(ISSET($_POST['login'])){
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		
		$query = mysqli_query($conn, "SELECT * FROM admins WHERE email = '$email' && password = '$password'") or die(mysqli_error());
		$fetch = mysqli_fetch_array($query);
		$row = $query->num_rows;
		
		if($row > 0){
			$_SESSION['users'] = $fetch['id'];
			header("location:manager.php");
		}else{
			echo "<center><label class='text-danger'>Invalid username or password</label></center>";
		}
	}
?>