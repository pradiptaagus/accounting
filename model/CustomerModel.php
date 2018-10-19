<?php
	include '../config/connection.php';

	function selectAllCustomer(){
		global $db;
		$sql = "SELECT tb_pelanggan.*, tb_kota.`nama` AS nama_kota, tb_propinsi.`nama` AS nama_propinsi, tb_negara.`nama` 
				AS nama_negara 
				FROM tb_pelanggan 
				LEFT JOIN tb_kota ON tb_pelanggan.`id_kota` = tb_kota.`id` 
				LEFT JOIN tb_propinsi ON tb_pelanggan.`id_propinsi` = tb_propinsi.`id` 
				LEFT JOIN tb_negara ON tb_pelanggan.`id_negara` = tb_negara.`id`";
		$result = mysqli_query($db, $sql);
		$dataArr = array();
		if($result){
			while ($row = mysqli_fetch_assoc($result)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function selectCustomer($id){
		global $db;
		$sql = "SELECT tb_pelanggan.*, tb_kota.`nama` AS nama_kota, tb_propinsi.`nama` AS nama_propinsi, tb_negara.`nama` 
				AS nama_propinsi 
				FROM tb_pelanggan 
				LEFT JOIN tb_kota ON tb_pelanggan.`id_kota` = tb_kota.`id` 
				LEFT JOIN tb_propinsi ON tb_pelanggan.`id_propinsi` = tb_propinsi.`id` 
				LEFT JOIN tb_negara ON tb_pelanggan.`id_negara` = tb_negara.`id` 
				WHERE tb_pelanggan.`id` = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}
?>