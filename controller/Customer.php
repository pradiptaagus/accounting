<?php
	include '../model/CustomerModel.php';

	if (isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch ($action) {
			case 'select':
				select();
				break;
			
			case 'selectAll':
				selectAll();
				break;
		}
	}

	function select(){
		$id = $_POST['id'];
		// select data with selected id
		$select = selectCustomer($id);
		// create response array
		$response = array(
			$select
		);
		// encode reponse to json format
		echo json_encode($response);
	}

	function selectAll(){
		// select all data from database
		$select = selectAllCustomer();
		// create response array
		$response = array(
			'data' => $select
		);
		// encode response to json format
		echo json_encode($response);
	}
?>