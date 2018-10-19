<?php
	include '../config/connection.php';

	function selectPosition($id){
		global $db;
		$sql = "SELECT * FROM tb_jabatan WHERE id = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function selectAllPosition(){
		global $db;
		$sql = "SELECT * FROM tb_jabatan";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function insertPosition($nama, $info){
		global $db;
		$sql = "INSERT INTO tb_jabatan(nama, keterangan) VALUES('$nama', '$info')";
		$result = mysqli_query($db, $sql);
		$last_id = "";
		if ($result) {
			$last_id = mysqli_insert_id($db);
		}
		return $last_id;
	}

	function updatePosition($id, $nama, $info){
		global $db;
		$sql = "UPDATE tb_jabatan SET nama = '$nama', keterangan = '$info' WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function deletePosition($id){
		global $db;
		$sql = "DELETE FROM tb_jabatan WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function countPosition(){
		global $db;

		$sql = "SELECT COUNT(id) AS jml_jabatan FROM tb_jabatan";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($db, $sql);
		return $result;
	}
?>