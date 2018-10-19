<?php
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
		}
    }
    
    // store
    function store(){
        $nama = $_POST['nama'];
        // insert data to database
        $insert = insertCountry($nama);
        // count data
        $response = array(
            'id' => $insert,
            'status' => 'success'
        );
        // encode response to json format
        echo json_encode($response);
    }

    // update
    function update(){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        // update data
        $update = updateCountry($id, $nama);
        // create response array
        $response = array(
            'id' => $id,
            'nama' => $nama
        );
        // encode response to json format
        echo json_encode($response);
    }

    function delete(){
        $id = $_POST['id'];
        // delete data with selected id
        $delete = deleteCountry($id);
        // create reponse array
        $response = array(
            'status' => 'success'
        );
        // encode response to json format
        echo json_encode($response);
    }

    function select(){
        $id = $_POST['id'];
        // select data with selected id
        $result = selectCountry($id);
        // create reponse array
        $response = array(
            $result
        );
        // encode response to json format
        echo json_encode($response);
    }

    function selectAll(){
        // select all data from database
        $result = selectAllCountry();
        // create response array
        $response = array(
            'data' => $result
        );
        // encode response to json format
        echo json_encode($response);
    }
?>