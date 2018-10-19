<?php
	include '../config/connection.php';
	include '../model/UserModel.php';
	include '../model/ProductModel.php';
	include '../model/SupplierModel.php';

	$limit = 10;
    $page;
    if(isset($_GET["page"])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }

    $start = ($page-1)*$limit;

    // $row = countUser();
    // $total_page = ceil($row['jml_user']/$limit);	
?>