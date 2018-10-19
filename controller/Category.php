<?php
	include '../config/connection.php';
	include '../model/CategoryModel.php';

	if(isset($_POST['action']) && !empty($_POST['action'])){
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

	function store(){
		$nama = $_POST['nama'];
		// insert data to database
		$insert = insertCategory($nama);
		// create response array
		$response = array(
			'id' => $insert,
			'status' => 'success'
		);
		echo json_encode($response);
	}

	function update(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		// update category
		$update = updateCategory($id, $nama);
		// create response array
		$response = array(
			'id' => $id,
			'nama' => $nama
		);
		echo json_encode($response);
	}

	function delete(){
		$id = $_POST['id'];
		// delete category
		$delete = deleteCategory($id);
		// create response array
		$response = array(
			'status' => 'success'
		);
		echo json_encode($response);
	}

	function select(){
		$id = $_POST['id'];
		// select data from database
		$result = selectCategory($id);
		// create response array
		$response = array(
			$result
		);
		echo json_encode($response);
	}

	function selectAll(){
		// select all data from database
		$result = selectAllCategory();
		// create response array
		$response = array(
			'data' => $result
		);
		echo json_encode($response);
	}
?>