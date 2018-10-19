<?php
	include '../config/connection.php';

	function selectCountry($id){
		global $db;
		$sql = "SELECT * FROM tb_negara WHERE id = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function selectAllCountry(){
		global $db;
		$sql = "SELECT * FROM tb_negara";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if($result){
			while ($row = mysqli_fetch_assoc($result)){
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function insertCountry($nama){
		global $db;
		$sql = "INSERT INTO tb_negara(nama) VALUES('$nama')";
		$result = mysqli_query($db, $sql);
		$last_id = "";
		if ($result) {
			$last_id = mysqli_insert_id($db);
		}
		return $last_id;
	}

	function updateCountry($id, $nama){
		global $db;
		$sql = "UPDATE tb_negara SET nama = '$nama' WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function deleteCountry($db, $sql){
		global $db;
		$sql = "DELETE FROM tb_negara WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function countCountry(){
		global $db; 
		$sql = "SELECT COUNT(id) AS jml_negara FROM tb_negara";
		$result = mysqli_query($db, $sql);
		return $result;
	}
?>