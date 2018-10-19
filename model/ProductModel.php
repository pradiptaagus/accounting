<?php
	include '../config/connection.php';

	function selectCode($code){
		global $db;
		$sql = "SELECT tb_barang.`kode` FROM tb_barang WHERE kode = '$code'";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function selectProduct($id){
		global $db;
		$sql = "SELECT tb_barang.*, tb_supplier.`nama` AS nama_supplier, 
				tb_satuan.`nama` AS nama_satuan, tb_satuan.`keterangan` as keterangan_satuan, tb_kategori.`nama` AS nama_kategori FROM tb_barang
				LEFT JOIN tb_supplier ON tb_barang.`id_supplier` = tb_supplier.`id`
				LEFT JOIN tb_satuan ON tb_barang.`id_satuan` = tb_satuan.`id` 
				LEFT JOIN tb_kategori ON tb_barang.`id_kategori` = tb_kategori.`id` WHERE tb_barang.`id` = $id";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function selectAllProduct(){
		global $db;
		$sql = "SELECT tb_barang.*, tb_supplier.`nama` AS nama_supplier, 
				tb_satuan.`nama` AS nama_satuan, tb_kategori.`nama` AS nama_kategori FROM tb_barang
				LEFT JOIN tb_supplier ON tb_barang.`id_supplier` = tb_supplier.`id`
				LEFT JOIN tb_satuan ON tb_barang.`id_satuan` = tb_satuan.`id` 
				LEFT JOIN tb_kategori ON tb_barang.`id_kategori` = tb_kategori.`id` ORDER BY tb_barang.`id`";
		$exec = mysqli_query($db, $sql);
		$dataArr = array();
		if ($exec) {
			while ($row = mysqli_fetch_assoc($exec)) {
				$dataArr[] = $row;
			}
		}
		return $dataArr;
	}

	function insertProduct($kode, $nama, $id_kategori, $harga_jual, $stok, $satuan, $diskon, $harga_beli, $pajak, $id_supplier){
		global $db;

		$sql = "INSERT INTO tb_barang (kode, nama, id_kategori, harga_jual, stok, id_satuan, diskon, harga_beli, pajak, id_supplier, created_date, updated_date)
				VALUES('$kode', '$nama', $id_kategori, $harga_jual, $stok, $satuan, $diskon, $harga_beli, $pajak, $id_supplier, NOW(), NOW())";
		$result = mysqli_query($db, $sql);
		$last_id = "";
		if ($result) {
			$last_id = mysqli_insert_id($db);
		}
		return $last_id;
	}

	function countProduct(){
		global $db;

		$sql = "SELECT COUNT(id) AS jml_produk FROM tb_barang";
		$exec = mysqli_query($db, $sql);
		$result = mysqli_fetch_assoc($exec);
		return $result;
	}

	function updateProduct($id, $kode, $nama, $id_kategori, $harga_jual, $stok, $id_satuan, $diskon, $harga_beli, $pajak, $id_supplier){
		global $db;
		$sql = "UPDATE tb_barang SET kode = '$kode', nama = '$nama', id_kategori = $id_kategori, harga_jual = $harga_jual, stok = $stok, id_satuan = $id_satuan, diskon = $diskon, harga_beli = $harga_beli, pajak = $pajak, id_supplier = $id_supplier, updated_date = NOW() WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

	function deleteProduct($id){
		global $db;
		$sql = "DELETE FROM tb_barang WHERE id = $id";
		$result = mysqli_query($db, $sql);
	}

?>