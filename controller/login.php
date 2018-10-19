<?php 
	include "../config/connection.php";

	$username = $_GET['user'];
	$password = $_GET['pass'];
	 
	$sql = mysqli_query($db, "SELECT tb_user.`id`, tb_user.`username` FROM tb_user WHERE username='$username' AND password=SHA($password)");
	$cek = mysqli_num_rows($sql);
	 
	if($cek > 0){
		session_start();
		$_SESSION['username'] = $username;
		$_SESSION['status'] = "login";
		header("location:../view/product.php");
	}else{
		header("location:../view/login.php");	
	}
?>