<?php
	include '../config/connection.php';

	function insertCategory($nama){
		global $db;

		$sql = "INSERT INTO tb_kategori(nama) VALUES('$nama')";
		$result = mysqli_query($db, $sql);
		$last_id = "";
		if($result){
			$last_id = mysqli_insert_id($db);
		}
		return $last_id;
	}

	function updateCategory($id, $nama){
		global $db;

		$sql = "UPDATE tb_kategori SET nama = '$nama' WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function deleteCategory($id){
		global $db;

		$sql = "DELETE FROM tb_kategori WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function selectCategory($id){
		global $db;

		$sql = "SELECT * FROM tb_kategori WHERE id = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function selectAllCategory(){
		global $db;

		$sql = "SELECT * FROM tb_kategori";
		$exec = mysqli_query($db, $sql);
		$dataArr = array();
		if ($exec) {
			while ($row = mysqli_fetch_assoc($exec)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function countCategory(){
		global $db;

		$sql = "SELECT COUNT(id) AS jml_kategori FROM tb_kategori";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($sql);
		return $result;
	}
?>