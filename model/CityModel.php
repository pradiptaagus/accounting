<?php
	include '../config/connection.php';

	function selectCity($id){
		global $db;
		$sql = "SELECT * FROM tb_kota WHERE id = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function selectSomeCity($id){
		global $db;
		$sql = "SELECT * FROM tb_kota WHERE id_propinsi = $id";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if ($result){
			while ($row = mysqli_fetch_assoc($result)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function selectAllCity(){
		global $db;
		$sql = "SELECT * FROM tb_kota";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if($result){
			while($row = mysqli_fetch_assoc($result)){
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function insertCity($nama, $id_propinsi){
		global $db;
		$sql = "INSERT INTO tb_kota(nama, id_propinsi) VALUES('$nama', $id_propinsi)";
		$result = mysqli_query($db, $sql);
		$last_id = "";
		if($result){
			$last_id = mysqli_insert_id($db);
		}
		return $last_id;
	}

	function updateCity($id, $nama, $id_propinsi){
		global $db;
		$sql = "UPDATE tb_kota SET nama = '$nama', id_propinsi = $id_propinsi WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function deleteCity($id){
		global $db;
		$sql = "DELETE FROM tb_kota WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function countCity(){
		global $db;
		$sql = "SELECT COUNT(id) AS jml_kota FROM tb_kota";
		$result = mysqli_query($db, $sql);
		return $result;
	}
?>