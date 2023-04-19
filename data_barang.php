<?php

class DataBarang
{
    private $db;

    public function __construct()
    {
        require_once "koneksi.php";
        $this->db = new DatabaseConnection();
    }

    public function getDataBarang()
    {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM data_barang";
        $result = $conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        $this->db->closeConnection();
        return $data;
    }

    public function insertDataBarang($gambar, $nama, $kategori, $harga_beli, $harga_jual, $stok)
    {
        $conn = $this->db->getConnection();
        $sql = "INSERT INTO data_barang (gambar, nama, kategori, harga_beli, harga_jual, stok) VALUES ('$gambar', '$nama', '$kategori', $harga_beli, $harga_jual, $stok)";
        if ($conn->query($sql) === TRUE) {
            $this->db->closeConnection();
            return true;
        } else {
            $this->db->closeConnection();
            return false;
        }
    }

    public function updateDataBarang($id, $gambar, $nama, $kategori, $harga_beli, $harga_jual, $stok)
    {
        $conn = $this->db->getConnection();
        $sql = "UPDATE data_barang SET gambar='$gambar', nama='$nama', kategori='$kategori', harga_beli=$harga_beli, harga_jual=$harga_jual, stok=$stok WHERE id_barang=$id";
        if ($conn->query($sql) === TRUE) {
            $this->db->closeConnection();
            return true;
        } else {
            $this->db->closeConnection();
            return false;
        }
    }

    public function deleteDataBarang($id)
    {
        $conn = $this->db->getConnection();
        $sql = "DELETE FROM data_barang WHERE id_barang=$id";
        if ($conn->query($sql) === TRUE) {
            $this->db->closeConnection();
            return true;
        } else {
            $this->db->closeConnection();
            return false;
        }
    }
}
