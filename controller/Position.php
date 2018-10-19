<?php
    include '../model/PositionModel.php';

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

    // store
    function store(){
        $nama = $_POST['nama'];
        $info = $_POST['keterangan'];
        // insert to database
        $insert = insertPosition($nama, $info);
        // create array response
        $response = array(
            'id' => $insert,
            'status' => 'success'
        );
        // encode response to json_format
        echo json_encode($response);
    }

    function update(){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $info = $_POST['keterangan'];
        // update data in database
        $update = updatePosition($id, $nama, $info);
        // create array response
        $response = array(
            'id' => $id,
            'nama' => $nama,
            'info' => $info
        );
        // encode response to json format
        echo json_encode($response);
    }

    function delete(){
        $id = $_POST['id'];
        // delete data from database with selected id
        $result = deletePosition($id);
        // create array response
        $response = array(
            'status' => 'success'
        );
        // encode response to json format
        echo json_encode($response);
    }

    function select(){
        $id = $_POST['id'];
        // select data from database with selected id
        $result = selectPosition($id);
        // create response array
        $response = array(
            $result
        );
        // encode response to json format
        echo json_encode($response);
    }

    function selectAll(){
        // select all data from database
        $result = selectAllPosition();
        // create array response
        $response = array(
            'data' => $result
        );
        // encode response to json format
        echo json_encode($response);
    }
?>