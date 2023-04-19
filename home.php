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