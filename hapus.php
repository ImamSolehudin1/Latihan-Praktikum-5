<?php
    require_once "data_barang.php";
    $dataBarang = new DataBarang();

    // Cek apakah ada data yang dikirimkan melalui URL
    if (isset($_GET['id_barang'])) {
        $id = $_GET['id_barang'];
        $result = $dataBarang->deleteDataBarang($id);
        if ($result) {
            header("Location: index.php");
            exit;
        }
    }
