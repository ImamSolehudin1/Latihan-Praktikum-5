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