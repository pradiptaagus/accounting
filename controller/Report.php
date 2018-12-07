<?php
    include '../model/ReportModel.php';

    if (isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		switch ($action) {
			case 'selectAll':
				getAllData();
                break;
            case 'selectLimit':
                selectLimit();
                break;
		}
    }
    
    // searchAll data
    function getAllData(){
        $data = selectPenjualan();
        $response = array(
            'data' => $data
        );
        echo json_encode($response);
    }

    function selectLimit(){
        $data = selectPenjualanLimit(9);
        $response = array(
            'data' => $data
        );
        echo json_encode($response);
    }
?>