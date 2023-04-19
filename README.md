# Lab5Web
- Nama : Imam Solehudin
- Nim : 312110290
- Kelas : TI.21.C.1
- Matkul : Pemrograman Web 2

1. Program form.php

```php
 <?php
    require_once "data_barang.php";
    require 'header.php';
    $dataBarang = new DataBarang();

    // Inisialisasi variabel
    $id = "";
    $gambar = "";
    $nama = "";
    $kategori = "";
    $harga_beli = "";
    $harga_jual = "";
    $stok = "";

    // Cek apakah ada data yang dikirimkan melalui URL (untuk edit)
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $barang = $dataBarang->getDataBarang($id)[0];
        if ($barang) {
            $gambar = $barang['gambar'];
            $nama = $barang['nama'];
            $kategori = $barang['kategori'];
            $harga_beli = $barang['harga_beli'];
            $harga_jual = $barang['harga_jual'];
            $stok = $barang['stok'];
        }
    }

    // Proses form ketika menekan tombol submit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $gambar = $_POST['gambar'];
        $nama = $_POST['nama'];
        $kategori = $_POST['kategori'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $stok = $_POST['stok'];

        // Cek apakah id ada, jika ada berarti edit data barang, jika tidak ada berarti tambah data barang
        if (!empty($id)) {
            // Edit data barang
            $result = $dataBarang->updateDataBarang($id, $gambar, $nama, $kategori, $harga_beli, $harga_jual, $stok);
            if ($result) {
                header("Location: index.php");
                exit;
            }
        } else {
            // Tambah data barang
            $result = $dataBarang->InsertDataBarang($gambar, $nama, $kategori, $harga_beli, $harga_jual, $stok);
            if ($result) {
                header("Location: index.php");
                exit;
            }
        }
    }
    ?>

    <h1 class="judul">Form Barang</h1>
    <div class="container-form">
        <form class="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Gambar:</label><br>
            <input type="text" name="gambar" value="<?php echo $gambar; ?>"><br>
            <label>Nama:</label><br>
            <input type="text" name="nama" value="<?php echo $nama; ?>"><br>
            <label>Kategori:</label><br>
            <input type="text" name="kategori" value="<?php echo $kategori; ?>"><br>
            <label>Harga Beli:</label><br>
            <input type="text" name="harga_beli" value="<?php echo $harga_beli; ?>"><br>
            <label>Harga Jual:</label><br>
            <input type="text" name="harga_jual" value="<?php echo $harga_jual; ?>"><br>
            <label>Stok:</label><br>
            <input type="text" name="stok" value="<?php echo $stok; ?>"><br>
            <input type="submit" name="submit" value="Simpan" class="tambah tombol">
            <a href="index.php" class="tambah tombol">Kembali</a>
        </form>
        
    </div>
    <?php require 'footer.php'; ?>

```

2. Program header.php

```php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Modularisasi</title>
</head>

<body>
    <div class="container">
        <header>
            <h1>Modularisasi Require</h1>
        </header>
        <nav>
            <a href="home">Home</a>
            <a href="about">Tentang</a>
            <a href="kontak">Kontak</a>
        </nav>
```

3. Program index.php

```php
<?php
if (isset($_GET['mod'])) {
    $mod = $_GET['mod'];
    switch ($mod) {
        case "home":
            require("home.php");
            break;
        case "about":
            require("about.php"); // perbaikan: tambahkan ekstensi file ".php"
            break;
        case "kontak":
            require("kontak.php"); // perbaikan: tambahkan ekstensi file ".php"
            break;
        default:
            require("home.php");
    }
} else {
    require("home.php");
}

```

4. program data_barang.php


```php
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
```

5. Program home.php


```php
    <?php
    require_once "data_barang.php";
    $dataBarang = new DataBarang();
    require 'header.php';

    // Menampilkan data
    $barangList = $dataBarang->getDataBarang();
    ?>
    <div class="tabel-container">
        <h1>Data Barang</h1>
        <table class="tabel">
            <tr>
                <th class="id_barang">ID</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($barangList as $barang) : ?>
                <tr>
                    <td class="id_barang"><?php echo $barang['id_barang']; ?></td>
                    <td><?php echo $barang['gambar']; ?></td>
                    <td><?php echo $barang['nama']; ?></td>
                    <td><?php echo $barang['kategori']; ?></td>
                    <td><?php echo $barang['harga_beli']; ?></td>
                    <td><?php echo $barang['harga_jual']; ?></td>
                    <td><?php echo $barang['stok']; ?></td>
                    <td>
                        <a href="form.php?id=<?php echo $barang['id_barang']; ?>">Edit</a>
                        <a href="hapus.php?id_barang=<?php echo $barang['id_barang']; ?>" onclick="return confirm('Yakin ingin menghapus data?')" ;>Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="form.php" class="tambah">Tambah Barang</a>
    </div>
    <?php require 'footer.php' ?>
```

6. Program hapus.php


```php
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

```

7. Program kontak.php


```php

<?php require('header.php'); ?>
<div class="content">
    <h2>Ini adalah Halaman Kontak.</h2>
    <p>Ini adalah content dari halaman.</p>
</div>
<?php require('footer.php'); ?>
```

8. Program about.php


```php
<?php require('header.php'); ?>
<div class="content">
    <h2>Ini Halaman Tentang</h2>
    <p>Ini adalah content dari halaman.</p>
</div>
<?php require('footer.php'); ?>
```

9. Program footer.php


```php
<footer>
    <p>&copy;Ceated by : Imamm</p>
</footer>
</div>
</body>

</html>
```

10. Program koneksi.php


```php
<?php

class DatabaseConnection
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "latihan1";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn->close();
    }
}

```
