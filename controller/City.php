<?php
	include '../model/CityModel.php';
	include '../model/ProvinceModel.php';

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
            
            case 'selectSome':
                selectSome();
                break;
            
            case 'selectAll':
                selectAll();
                break;
        }
	}
	
	function store(){
		$nama = $_POST['nama'];
		$id_propinsi = $_POST['id-propinsi'];
		// insert data to database
		$insert = insertCity($nama, $id_propinsi);
		// create response array
		$response = array(
			'id' => $insert,
			'status' => 'success'
		);
		// encode reponse to json format
		echo json_encode($response);
	}

	function update(){
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$id_propinsi = $_POST['id-propinsi'];
		// update data 
		$update = updateCity($id, $nama, $id_propinsi);
		// select propinsi with selected id
		$propinsi = selectProvince($id_propinsi);
		// create response array
		$response = array(
			'id' => $id,
			'nama' => $nama,
			'propinsi' => $propinsi['nama']
		);
		// encode response to json format
		echo json_encode($response);
	}

	function delete(){
		$id = $_POST['id'];
		// delete data with selected id
		$delete = deleteCity($id);
		// create response array
		$response = array(
			'delete' => 'berhasil'
		);
		// encode response to json format
		echo json_encode($response);
	}

	function select(){
		$id_kota = $_POST['id'];
		// select data with selected id
		$select = selectCity($id_kota);
		// create response array
		$response = array(
			'data' => $select
		);
		// encode response to json format
		echo json_encode($response);
	}

	function selectSome(){
		$id_propinsi = $_POST['id'];
		// select data with selected id
		$select = selectSomeCity($id_propinsi);
		// create response array
		$response = array(
			'data' => $select
		);
		// encode response to json format
		echo json_encode($response);
	}

	function selectAll(){
		// select all data from database
		$select = selectAllCity();
		// create response array
		$response = array(
			'data' => $select
		);
		// encode response to json format
		echo json_encode($response);
	}
?>