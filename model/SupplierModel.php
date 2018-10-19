<?php
	include '../config/connection.php';

	function selectSupplier($id){
		global $db;
		
		$sql = "SELECT tb_supplier.*, tb_negara.`nama` AS nama_negara, tb_propinsi.`nama` AS nama_propinsi, tb_kota.`nama` AS nama_kota FROM tb_supplier 
				LEFT JOIN tb_negara ON tb_supplier.`id_negara` = tb_negara.`id` 
				LEFT JOIN tb_propinsi ON tb_supplier.`id_propinsi` = tb_propinsi.`id` 
				LEFT JOIN tb_kota ON tb_supplier.`id_kota` = tb_kota.`id`
				WHERE tb_supplier.`id` = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function selectAllSupplier(){
		global $db;
		$sql = "SELECT tb_supplier.*, tb_negara.`nama` AS nama_negara, tb_propinsi.`nama` AS nama_propinsi, tb_kota.`nama` AS nama_kota FROM tb_supplier 
				LEFT JOIN tb_negara ON tb_supplier.`id_negara` = tb_negara.`id` 
				LEFT JOIN tb_propinsi ON tb_supplier.`id_propinsi` = tb_propinsi.`id` 
				LEFT JOIN tb_kota ON tb_supplier.`id_kota` = tb_kota.`id` 
				ORDER BY tb_supplier.`id`";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$dataArr[] = $row;
			}
		}
		return$dataArr;
	}

	function countSupplier(){
		global $db;

		$sql = "SELECT COUNT(id) as jml_supplier FROM tb_supplier";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function insertSupplier($nama, $alamat, $id_kota, $id_propinsi, $id_negara, $telepon, $hp, $email, $website){
		global $db;

		$sql = "INSERT INTO tb_supplier(nama, alamat, id_kota, id_propinsi, id_negara, telepon, hp, email, website, created_date, updated_date) VALUE('$nama', '$alamat', '$id_kota', '$id_propinsi', '$id_negara', '$telepon', '$hp', '$email', '$website', NOW(), NOW())";
		$last_id = "";
		$result = mysqli_query($db, $sql);
		if ($result) {
			$last_id = mysqli_insert_id($db);
		}
		return $last_id;
	}

	function updateSupplier($id, $nama, $alamat, $id_kota, $id_propinsi, $id_negara, $telepon, $hp, $email, $website){
		global $db;
		$sql = "UPDATE tb_supplier SET nama = '$nama', alamat = '$alamat', id_kota = '$id_kota', id_propinsi = '$id_propinsi', id_negara = '$id_negara', telepon = '$telepon', hp = '$hp', email = '$email', website = '$website', updated_date = NOW()
			WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function deleteSupplier($id){
		global $db;
		$sql = "DELETE FROM tb_supplier WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function nameEdit($id, $nama){
		global $db;
		$sql = "SELECT COUNT(id) AS jml FROM tb_supplier WHERE nama = '$nama' AND id != $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function nameAdd($nama){
		global $db;
		$sql = "SELECT COUNT(id) AS jml FROM tb_supplier WHERE nama = '$nama'";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}
?>