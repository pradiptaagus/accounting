<?php
	include '../config/connection.php';

	function selectProvince($id){
		global $db;
		$sql = "SELECT * FROM tb_propinsi WHERE id = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function selectSomeProvince($id){
		global $db;
		$sql = "SELECT * FROM tb_propinsi WHERE id_negara = $id";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function selectAllProvince(){
		global $db;
		$sql = "SELECT * FROM tb_propinsi";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if ($result) {
			while($row = mysqli_fetch_assoc($result)){
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function insertProvince($nama, $id_negara){
		global $db;
		$sql = "INSERT INTO tb_propinsi(nama, id_negara) VALUES('$nama', $id_negara)";
		$result = mysqli_query($db, $sql);
		$last_id = "";
		if ($result) {
			$last_id = mysqli_insert_id($db);
		}
		return $last_id;
	}

	function updateProvince($id, $nama, $id_negara){
		global $db;
		$sql = "UPDATE tb_propinsi SET nama = '$nama', id_negara = $id_negara WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function deleteProvince($id){
		global $db;
		$sql = "DELETE FROM tb_propinsi WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function countProvince(){
		global $db;
		$sql = "SELECT COUNT(id) AS jml_propinsi FROM tb_propinsi";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}
?>