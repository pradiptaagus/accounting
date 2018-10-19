<?php
	session_start();

	// cek apakah user sudah login atau belum
	// jika belum, user akan dialihkan ke halaman login
	// if($_SESSION['status'] != 'login'){
	// 	header("location:../view/login.php");
	// }else{
	// 	header("location:../view/master-barang.php");
	// }

	// include '../controller/Auth.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<?php include 'asset_css.php' ?>
</head>
<body>
	<div class="text-center" style="max-width: 300px; margin: auto; margin-top: 20vh">
		<form type="post" action="../controller/login.php" onSubmit="return validation()">
			<i class="fa fa-key mb-3" style="font-size: 46px"></i>
			<h1 class="text-center h3 mb-3">Login</h1>
			
			<div class="container">
				<input id="username" class="form-control mb-3" type="text" name="user" placeholder="Username">
				<input id="password" class="form-control mb-3" type="password" name="pass" placeholder="Password">
				<button class="btn btn-primary btn-block mt-2" type="submit">Login</button>
			</div>
		</form>
	</div>

	<?php include 'asset_js.php' ?>
	<script>
		function validation(){
			var username = document.getElementById('username').value;
			var password = document.getElementById('password').value;

			if(username != "" && password != ""){
				return true;
			}else{
				alert("Username dan password harus diisi !");
				return false;
			}
		}
	</script>
</body>
</html>
