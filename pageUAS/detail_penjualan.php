<?php
// Menghubungkan file koneksi database
include "config/koneksi1.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                <!-- Judul halaman -->
                <h1 class="m-0 text-dark">Data Detail Penjualan</h1>

            </div>
        </div>
    </div>
</div>

<?php
// Mengecek apakah ada parameter action pada URL
if(isset($_GET['action'])){

    // Jika action = hapus
    if($_GET['action']=="hapus"){

        // Mengambil id_detail dari URL
        $id = $_GET['id'];

        // Query menghapus data detail penjualan berdasarkan id_detail
        $hapus = mysqli_query($koneksi,"
            DELETE FROM detail_penjualan
            WHERE id_detail='$id'
        ");

        // Jika berhasil dihapus
        if($hapus){
            echo "
            <div class='alert alert-success'>
                Data Berhasil Dihapus
            </div>";

            // Redirect kembali ke halaman detail penjualan
            echo "<meta http-equiv='refresh' content='1;url=index1.php?pageUAS=detail_penjualan'>";
        }
    }
}
?>

<div class="content">
<div class="container-fluid">

<div class="card">
<div class="card-body">

<!-- Tombol menuju halaman tambah detail penjualan -->
<a href="index1.php?pageUAS=tambah_detail"
   class="btn btn-primary btn-sm">
   Tambah Detail Penjualan
</a>

<br><br>

<!-- Tabel menampilkan data detail penjualan -->
<table class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>No</th>
            <th>ID Penjualan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

<?php

// Variabel nomor urut
$no = 0;

// Query menampilkan data detail penjualan
// Digabung dengan tabel_produk agar nama produk dapat ditampilkan
$query = mysqli_query($koneksi,"
SELECT dp.*,
       p.nama_produk
FROM detail_penjualan dp
INNER JOIN tabel_produk p
ON dp.id_produk = p.id_produk
");

// Perulangan data hasil query
while($data = mysqli_fetch_array($query)){

    // Menambah nomor urut
    $no++;
?>

<tr>

    <!-- Nomor urut -->
    <td><?= $no; ?></td>

    <!-- Menampilkan ID Penjualan -->
    <td><?= $data['id_penjualan']; ?></td>

    <!-- Menampilkan Nama Produk -->
    <td><?= $data['nama_produk']; ?></td>

    <!-- Menampilkan Jumlah Produk -->
    <td><?= $data['jumlah']; ?></td>

    <!-- Menampilkan Subtotal dengan format rupiah -->
    <td>Rp <?= number_format($data['subtotal']); ?></td>

    <td>

        <!-- Tombol Hapus -->
        <a href="index1.php?pageUAS=detail_penjualan&action=hapus&id=<?= $data['id_detail']; ?>"
           onclick="return confirm('Yakin ingin menghapus data?')">

            <span class="badge badge-danger">
                Hapus
            </span>

        </a>

        <!-- Tombol Edit -->
        <a href="index1.php?pageUAS=edit_detail&id=<?= $data['id_detail']; ?>">

            <span class="badge badge-warning">
                Edit
            </span>

        </a>

    </td>

</tr>

<?php
}
?>

    </tbody>

</table>

</div>
</div>

</div>
</div>