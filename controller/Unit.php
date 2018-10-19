<?php
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
		}
	}

	// Store
	function store(){
		$nama = $_POST['nama'];
		$keterangan = $_POST['keterangan'];
		// insert data to database
		$insert = insertUnit($nama, $keterangan);
		// create reponse array
		$response = array(
		   	'id' => $insert,
		   	'status' => 'success'
	  	);

	  	echo json_encode($response);
	}

	// Update
	function update(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$keterangan = $_POST['keterangan'];
		// update data with selected id
		$update = updateUnit($id, $nama, $keterangan);
		// create response array
		$response = array(
			'id' => $id,
		   	'nama' => $nama,
		   	'keterangan' => $keterangan
	  	);
		// encode response to json format
	  	echo json_encode($response);
	}

	// Delete
	function delete(){
		$id = $_POST['id'];
		// delete data with selected id
		$delete = deleteUnit($id);
		// create response array
		$response = array(
			'status' => 'success'
	  	);
		// encode response to json format
	  	echo json_encode($response);
	}

	function select(){
		$id = $_POST['id'];
		// select data with selected id
		$select = selectUnit($id);
		// create response array
		$response = array(
			$select
		);
		// encode response to json format
		echo json_encode($response);
	}

	function selectAll(){
		// select all data from database
		$select = selectAllUnit();
		// create response array
		$response = array(
			'data' => $select
		);
		// encode response to json format
		echo json_encode($response);
	}
?>