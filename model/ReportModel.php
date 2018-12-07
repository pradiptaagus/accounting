<?php
    include '../config/connection_dwh.php';

    function selectPenjualan() {
        global $db;

        $sql = "SELECT dm_barang.id, dm_barang.nama, SUM(jml_barang) AS total FROM dm_fakta
                INNER JOIN dm_barang ON dm_barang.id = dm_fakta.id_barang
                WHERE id_barang = dm_fakta.id_barang
                GROUP BY dm_barang.id
                ORDER BY total DESC";

        $exec = mysqli_query($db, $sql);
        $dataArr = array();
        if ($exec) {
            while ($row = mysqli_fetch_assoc($exec)) {
                $dataArr[] = $row;
            }
        }
        return $dataArr;
    }

    function selectPenjualanLimit($limit){
        global $db;

        $sql = "SELECT dm_barang.id, dm_barang.nama, SUM(jml_barang) AS total FROM dm_fakta
                INNER JOIN dm_barang ON dm_barang.id = dm_fakta.id_barang
                WHERE id_barang = dm_fakta.id_barang
                GROUP BY dm_barang.id
                ORDER BY total DESC
                LIMIT $limit";

        $exec = mysqli_query($db, $sql);
        $dataArr = array();
        if ($exec) {
            while ($row = mysqli_fetch_assoc($exec)) {
                $dataArr[] = $row;
            }
        }
        return $dataArr;
    }
?>