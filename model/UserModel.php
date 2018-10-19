<?php
	include '../config/connection.php';

	function selectNikAdd($nik){
		global $db;
		$sql = "SELECT tb_user.`nama` FROM tb_user WHERE nik = '$nik'";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function selectNikEdit($nik, $id){
		global $db;
		$sql = "SELECT tb_user.`nama` FROM tb_user WHERE nik = '$nik' AND id != $id";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if ($result){
			while ($row = mysqli_fetch_assoc($result)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function selectUser($id){
		global $db;

		$sql = "SELECT tb_user.*, tb_jabatan.`nama` AS nama_jabatan, tb_negara.`nama` AS nama_negara, 
				tb_propinsi.`nama` AS nama_propinsi, tb_kota.`nama` AS nama_kota FROM tb_user
				LEFT JOIN tb_jabatan ON tb_user.`id_jabatan` = tb_jabatan.`id` 
				LEFT JOIN tb_negara ON tb_user.`id_negara` = tb_negara.`id` 
				LEFT JOIN tb_propinsi ON tb_user.`id_propinsi` = tb_propinsi.`id`
				LEFT JOIN tb_kota ON tb_user.`id_kota` = tb_kota.`id` 
				WHERE tb_user.`id` = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function selectAllUser(){
		global $db;
		$sql = "SELECT tb_user.*, tb_jabatan.`nama` AS nama_jabatan, tb_kota.`nama` AS nama_kota, 
				tb_propinsi.`nama` AS nama_propinsi, tb_negara.`nama` AS nama_negara FROM tb_user 
				LEFT JOIN tb_jabatan ON tb_user.`id_jabatan` = tb_jabatan.`id` 
				LEFT JOIN tb_kota ON tb_user.`id_kota` = tb_kota.`id` 
				LEFT JOIN tb_propinsi ON tb_user.`id_propinsi` = tb_propinsi.`id`
				LEFT JOIN tb_negara ON tb_user.`id_negara` = tb_negara.`id` 
				ORDER BY tb_user.`id`";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function storeUser($nik, $nama, $username, $password, $id_jabatan, $tempat_lahir, $tgl_lahir, $alamat, $id_kota, $id_propinsi, $id_negara, $telepon, $hp, $email, $keterangan, $status){
		global $db;
		$sql = "INSERT INTO tb_user (nik, nama, username, password, id_jabatan, tempat_lahir, tgl_lahir, alamat, id_kota, id_propinsi, id_negara, telepon, hp, email, keterangan, status, created_date, updated_date) VALUES ('$nik', '$nama', '$username', '$password', '$id_jabatan', '$tempat_lahir', '$tgl_lahir', '$alamat', '$id_kota', '$id_propinsi', '$id_negara', '$telepon', '$hp', '$email', '$keterangan', '$status', NOW(), NOW())";
		$result = mysqli_query($db, $sql);
		$last_id = "";
		if ($result) {
			$last_id = mysqli_insert_id($db);
		}
		return $last_id;
	}

	function updateUser($id, $nik, $nama, $id_jabatan, $tempat_lahir, $tgl_lahir, $id_negara, $id_propinsi, $id_kota, $alamat, $telepon, $hp, $email, $status, $keterangan){
		global $db;
		$sql = "UPDATE tb_user SET nik = '$nik', nama = '$nama', id_jabatan = $id_jabatan, tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', id_negara = $id_negara, id_propinsi = $id_propinsi, id_kota = $id_kota, alamat = '$alamat', telepon = '$telepon', hp = '$hp', email = '$email', status = $status, keterangan = '$keterangan', updated_date = NOW() WHERE id = $id";
		$result = mysqli_query($db, $sql); 
	}

	function deleteUser($id){
		global $db;
		$sql = "DELETE FROM tb_user WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function countUser(){
		global $db;
		$sql = "SELECT COUNT(id) AS jml_user FROM tb_user";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function getLastId(){
		global $db;
		$sql = "SELECT MAX(id) AS id FROM tb_user";
		$row = mysqli_query($db,$sql);
		$result = mysqli_fetch_assoc($row);
		return $result;
	}
?>