<?php
	include '../model/ProductModel.php';
	include '../model/CategoryModel.php';
	include '../model/SupplierModel.php';
	include '../model/UnitModel.php';

	if (isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch ($action) {
			case 'store':
				store();
				break;
			case 'update':
				update();
				break;
			case 'delete':
				delete();
				break;
			case 'select':
				select();
				break;
			case 'selectAll':
				selectAll();
				break;
			case 'code':
				code();
				break;
		}
	}

	// Store
	function store(){
		$kode = $_POST['kode'];
		$nama = $_POST['nama'];
		$id_kategori = $_POST['id-kategori'];
		$harga_jual = $_POST['harga-jual'];
		$stok = $_POST['stok'];
		$id_satuan = $_POST['id-satuan'];
		$diskon = $_POST['diskon'];
		$harga_beli = $_POST['harga-beli'];
		$pajak = $_POST['pajak'];
		$id_supplier = $_POST['id-supplier'];

		// validasi
		if ($stok == null) {
			$stok = 0;
		}
		if ($pajak == null) {
			$pajak = 0;
		}
		if ($diskon == null) {
			$diskon = 0;
		}

		// insert product
		$insert = insertProduct($kode, $nama, $id_kategori, $harga_jual, $stok, $id_satuan, $diskon, $harga_beli, $pajak, $id_supplier);
		// create response array
		$response = array(
			'id' => $insert,
			'status' => 'success'
	  	);
	  	echo json_encode($response);
	}

	// Update
	function update(){
		$id = $_POST['id'];
		$kode = $_POST['kode'];
		$nama = $_POST['nama'];
		$id_kategori = $_POST['id-kategori'];
		$harga_jual = $_POST['harga-jual'];
		$stok = $_POST['stok'];
		$id_satuan = $_POST['id-satuan'];
		$diskon = $_POST['diskon'];
		$harga_beli = $_POST['harga-beli'];
		$pajak = $_POST['pajak'];
		$id_supplier = $_POST['id-supplier'];
		$updated_at = date('Y-m-d H:i:s');
		// update product
		$update = updateProduct($id, $kode, $nama, $id_kategori, $harga_jual, $stok, $id_satuan, $diskon, $harga_beli, $pajak, $id_supplier);
		// select data satuan
		$nama_satuan = selectUnit($id_satuan);
		// select data supplier
		$nama_supplier = selectSupplier($id_supplier);
		// Select kategori
		$nama_kategori = selectCategory($id_kategori);
		// create response array
		$response = array(
			'id' => $id,
			'kode' => $kode,
		   	'nama' => $nama,
		   	'id-kategori' => $id_kategori,
		   	'nama-kategori' => $nama_kategori['nama'],
		   	'stok' => $stok,
		   	'id-satuan' => $id_satuan,
		   	'nama-satuan' => $nama_satuan['nama'],
		   	'harga-jual' => $harga_jual,
		   	'diskon' => $diskon,
		   	'harga-beli'=> $harga_beli,	   	
		   	'id-supplier' => $id_supplier,
		   	'nama-supplier' => $nama_supplier['nama'],
		   	'pajak' => $pajak,
		   	'updated-at' => $updated_at
	  	);
	  	echo json_encode($response);
	}

	// Delete
	function delete(){
		$id = $_POST['id'];
		// delete product
		$delete = deleteProduct($id);	
		// create response array
		$response = array(
			'status' => 'success'
	  	);
	  	echo json_encode($response);
	}

	function select(){
		$id = $_POST['id'];
		// select data from database
		$result = selectProduct($id);
		// create response array
		$response = array(
			$result
		);
		echo json_encode($response);
	}

	function selectAll(){
		// select all data from database
		$result = selectAllProduct();
		// create response array
		$response = array(
			'data' => $result
		);
		echo json_encode($response);
	}

	function code(){
		$code = $_POST['kode'];
		$result = selectCode($code);
		$response = array(
			'data' => $result
		);
		echo json_encode($response);
	}
?>