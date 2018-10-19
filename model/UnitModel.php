<?php
	include '../config/connection.php';

	function selectAllUnit(){
		global $db;

		$sql = "SELECT * FROM tb_satuan";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function selectUnit($id){
		global $db;
		
		$sql = "SELECT * FROM tb_satuan WHERE id = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function insertUnit($nama, $keterangan){
		global $db;
		$sql = "INSERT INTO tb_satuan (nama, keterangan) VALUE('$nama', '$keterangan')";
		$result = mysqli_query($db, $sql);
		$last_id = "";
		if ($result) {
			$last_id = mysqli_insert_id($db);
		}
		return $last_id;
	}

	function countUnit(){
		global $db;
		$count = "SELECT COUNT(id) as jml_satuan FROM tb_satuan";
		$countExec = mysqli_query($db, $count) or die(mysql_error());
		$countResult = mysqli_fetch_assoc($countExec);
		return $countResult;
	}

	function updateUnit($id, $nama, $keterangan){
		global $db;
		$sql = "UPDATE tb_satuan SET nama = '$nama', keterangan = '$keterangan' WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function deleteUnit($id){
		global $db;
		$sql = "DELETE FROM tb_satuan WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}
?>