<?php
	include '../model/SupplierModel.php';
	include '../model/CountryModel.php';
	include '../model/ProvinceModel.php';
	include '../model/CityModel.php';

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

			case 'checkNameAdd':
				checkNameAdd();
				break;

			case 'checkNameEdit':
				checkNameEdit();
				break;
		}
	}

	// Store
	function store(){
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$id_negara = $_POST['id-negara'];
		$id_propinsi = $_POST['id-propinsi'];
		$id_kota = $_POST['id-kota'];
		$telepon = $_POST['telepon'];
		$hp = $_POST['hp'];
		$email = $_POST['email'];
		$website = $_POST['website'];
		// insert data to database
		$insert = insertSupplier($nama, $alamat, $id_kota, $id_propinsi, $id_negara, $telepon, $hp, $email, $website);
		// create response array
		$response = array(
			'id' => $insert,
			'status' => 'success',
	  	);
		// encode reponse to json format
	  	echo json_encode($response);
	}

	// Update
	function update(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$id_negara = $_POST['id-negara'];
		$id_propinsi = $_POST['id-propinsi'];
		$id_kota = $_POST['id-kota'];
		$telepon = $_POST['telepon'];
		$hp = $_POST['hp'];
		$email = $_POST['email'];
		$website = $_POST['website'];
		// update data with selected id
		$update = updateSupplier($id, $nama, $alamat, $id_kota, $id_propinsi, $id_negara, $telepon, $hp, $email, $website);
		// select negara
		$country = selectCountry($id_negara);
		// select propinsi 
		$province = selectProvince($id_propinsi);
		// Select Kota 
		$city = selectCity($id_kota);
		// create response array
		$response = array(
			'id' => $id,
		   	'nama' => $nama,
			'alamat' => $alamat,
			'id-kota' => $id_kota,
			'nama-kota' => $city['nama'],
			'id-propinsi' => $id_propinsi,
			'nama-propinsi' => $province['nama'],
			'id-negara' => $id_negara,
			'nama-negara' => $country['nama'],
			'telepon' => $telepon,
			'hp' => $hp,
			'email' => $email,
			'website' => $website
	  	);
		// encode reponse to json format
	  	echo json_encode($response);
	}

	// Delete
	function delete(){
		$id = $_POST['id'];
		// delete
		$delete = deleteSupplier($id);
		// create response array
		$response = array(
			'status' => 'success'
	  	);
		// encode reponse to json format
	  	echo json_encode($response);
	}

	function select(){
		$id = $_POST['id'];
		// select data with selected id
		$select = selectSupplier($id);
		// create response array
		$response = array(
			$select
		);
		// encode reponse to json format
		echo json_encode($response);
	}

	function selectAll(){
		// select all data from database
		$select = selectAllSupplier();
		// create response array
		$response = array(
			'data' => $select
		);
		// encode reponse to json format
		echo json_encode($response);
	}

	function checkNameAdd(){
		$nama = $_POST['nama'];
		// check column name in table supplier
		$check = nameAdd($nama);
		// create response array
		$response = array(
			$check
		);
		echo json_encode($response);
	}

	function checkNameEdit(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		// check column name in table supplier
		$check = nameEdit($id, $nama);
		// create response array
		$response = array(
			$check
		);
		echo json_encode($response);
	}
?>