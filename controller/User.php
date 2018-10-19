<?php
	include '../model/UserModel.php';
	include '../model/PositionModel.php';
	include '../model/CityModel.php';
	include '../model/ProvinceModel.php';
	include '../model/CountryModel.php';

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
			case 'checkNikAdd':
				checkNikAdd();
				break;
			case 'checkNikEdit':
				checkNikEdit();
				break;
			case 'lastId':
				lastId();
				break;
		}
	}

	// Create
	function store(){
		$nik = $_POST['nik'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$id_jabatan = $_POST['id-jabatan'];
		$tempat_lahir = $_POST['tempat-lahir'];
		$tgl_lahir = $_POST['tgl-lahir'];
		$alamat = $_POST['alamat'];
		$id_kota = $_POST['id-kota'];
		$id_propinsi = $_POST['id-propinsi'];
		$id_negara = $_POST['id-negara'];
		$telepon = $_POST['telepon'];
		$hp = $_POST['hp'];
		$email = $_POST['email'];
		$keterangan = $_POST['keterangan'];
		$status = $_POST['status'];
		// insert user to database
		$insert = storeUser($nik, $nama, $username, $password, $id_jabatan, $tempat_lahir, $tgl_lahir, $alamat, $id_kota, $id_propinsi, $id_negara, $telepon, $hp, $email, $keterangan, $status);
		// create response array
		$response = array(
			'id' => $insert,
			'status' => 'success'
		);
		// encode reponse to json format
		echo json_encode($response);

	}
	
	//Update
	function update(){
		$id = $_POST['id'];
		$nik = $_POST['nik'];
		$nama = $_POST['nama'];
		$id_jabatan = $_POST['id-jabatan'];
		$tempat_lahir = $_POST['tempat-lahir'];
		$tgl_lahir = $_POST['tgl-lahir'];
		$id_negara = $_POST['id-negara'];
		$id_propinsi = $_POST['id-propinsi'];
		$id_kota = $_POST['id-kota'];
		$alamat = $_POST['alamat'];
		$telepon = $_POST['telepon'];
		$hp = $_POST['hp'];
		$email = $_POST['email'];
		$status = $_POST['status'];
		$keterangan = $_POST['keterangan'];
		// update data with selected id
		$update = updateUser($id, $nik, $nama, $id_jabatan, $tempat_lahir, $tgl_lahir, $id_negara, $id_propinsi, $id_kota, $alamat, $telepon, $hp, $email, $status, $keterangan);
		// select data jabatan
		$position = selectPosition($id_jabatan);
		// select kota 
		$city = selectCity($id_kota);
		// select propinsi
		$province = selectProvince($id_propinsi);
		// select negara
		$country = selectCountry($id_negara);
		// create response array
		$response = array(
			'id' => $id,
			'nik' => $nik,
			'nama' => $nama,
			'id-jabatan' => $id_jabatan,
			'nama-jabatan' => $position['nama'],
			'tempat-lahir' => $tempat_lahir,
			'tgl-lahir' => $tgl_lahir,
			'id-kota' => $id_kota,
			'nama-kota' => $city['nama'],
			'id-propinsi' => $id_propinsi,
			'nama-propinsi' => $province['nama'],
			'id-negara' => $id_negara,
			'nama-negara' => $country['nama'],
			'alamat' => $alamat,
			'telepon' => $telepon,
			'hp' => $hp,
			'email' => $email,
			'status' => $status,
			'keterangan' => $keterangan
		);
		// encode response to json format
		echo json_encode($response);
	}

	//Delete
	function delete(){
		$id = $_POST['id'];
		// delete user
		$delete = deleteUser($id);
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
		$select = selectUser($id);
		// create response array
		$response = array(
			$select
		);
		// encode response to json format
		echo json_encode($response);
	}

	function selectAll(){
		// select all data from database
		$select = selectAllUser();
		// create response array
		$response = array(
			'data' => $select
		);
		// encode response to json format
		echo json_encode($response);
	}

	function checkNikAdd(){
		$nik = $_POST['nik'];
		$select = selectNikAdd($nik);
		$response = array(
			'data' => $select
		);
		echo json_encode($response);
	}

	function checkNikEdit(){
		$nik = $_POST['nik'];
		$id = $_POST['id'];
		$select = selectNikEdit($nik, $id);
		$response = array(
			'data' => $select
		);
		echo json_encode($response);
	}

	function lastId(){
		$id = getLastId();
		echo json_encode($id);
	}
?>