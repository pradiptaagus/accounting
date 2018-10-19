<?php
	include '../config/connection.php';

	if (isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch ($action) {
			case 'login':
				store();
				break;
			
			case 'logout':
				update();
				break;
		}
	}

	// Create
	function login(){
		global $db;

		$username = $_GET['user'];
		$password = $_GET['pass'];
		 
		$sql = mysqli_query($db, "select * from tb_user where username='$username' and password='$password'");
		$cek = mysqli_num_rows($sql);
		 
		if($cek > 0){
			// $id = mysqli_query($db, "select id from tb_user where username='$username' and pass='$password'");
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login";
			header("location:../view/master-barang.php");
		}else{
			header("location:../view/login.php");	
		}
	}

	// Update
	function logout(){
		session_start();
		session_destroy();
		header("location:../view/login.php");
	}
?>