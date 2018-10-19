<?php
    include '../model/ProvinceModel.php';
    include '../model/CountryModel.php';

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

    // store
    function store(){
        $nama = $_POST['nama'];
        $id_negara = $_POST['id-negara'];
        // insert data to database
        $insert = insertProvince($nama, $id_negara);
        // create response array
        $response = array(
            'id' => $insert,
            'status' => 'success'
        );
        // encode response to json format
        echo json_encode($response);
    }

    function update(){
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $id_negara = $_POST['id-negara'];
        // update data
        $update = updateProvince($id, $nama, $id_negara);
        // select data country
        $negara = selectCountry($id);
        // create response array
        $response = array(
            'id' => $id,
            'nama' => $nama,
            'negara' => $negara['nama']
        );
        // encode response to json format
        echo json_encode($response);
    }

    function delete(){
        $id = $_POST['id'];
        // delete province with selected id
        $delete = deleteProvince($id);
        // create response array
        $response = array(
            'status' => 'success'
        );
        // encode response to json format
        echo json_encode($response);
    }

    function select(){
        $id_propinsi = $_POST['id'];
        // select province with selected id
        $result = selectProvince($id_propinsi);
        // create response array
        $response = array(
            'data' => $result
        );
        // encode response to json format
        echo json_encode($response);
    }

    function selectSome(){
        $id = $_POST['id'];
        // select province with selected id
        $result = selectSomeProvince($id);
        // create response array
        $response = array(
            'data' => $result
        );
        // encode response to json format
        echo json_encode($response);
    }

    function selectAll(){
        $result = selectAllProvince();
        // create response array
        $response = array(
            'data' => $result
        );
        // encode response to json format
        echo json_encode($response);
    }
?>