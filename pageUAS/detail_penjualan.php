<?php
include "config/koneksi1.php";
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Detail Penjualan</h1>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_GET['action'])){
    if($_GET['action']=="hapus"){

        $id = $_GET['id'];

        $hapus = mysqli_query($koneksi,"
            DELETE FROM detail_penjualan
            WHERE id_detail='$id'
        ");

        if($hapus){
            echo "
            <div class='alert alert-success'>
                Data Berhasil Dihapus
            </div>";

            echo "<meta http-equiv='refresh' content='1;url=index1.php?pageUAS=detail_penjualan'>";
        }
    }
}
?>

<div class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<a href="index1.php?pageUAS=tambah_detail"
   class="btn btn-primary btn-sm">
   Tambah Detail Penjualan
</a>

<br><br>

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
$no=0;

$query=mysqli_query($koneksi,"
SELECT dp.*,
       p.nama_produk
FROM detail_penjualan dp
INNER JOIN tabel_produk p
ON dp.id_produk=p.id_produk
");

while($data=mysqli_fetch_array($query)){
$no++;
?>

<tr>
    <td><?= $no; ?></td>
    <td><?= $data['id_penjualan']; ?></td>
    <td><?= $data['nama_produk']; ?></td>
    <td><?= $data['jumlah']; ?></td>
    <td>Rp <?= number_format($data['subtotal']); ?></td>

    <td>

        <a href="index1.php?pageUAS=detail_penjualan&action=hapus&id=<?= $data['id_detail']; ?>"
           onclick="return confirm('Yakin ingin menghapus data?')">
            <span class="badge badge-danger">Hapus</span>
        </a>

        <a href="index1.php?pageUAS=edit_detail&id=<?= $data['id_detail']; ?>">
            <span class="badge badge-warning">Edit</span>
        </a>

    </td>
</tr>

<?php } ?>

    </tbody>
</table>

</div>
</div>
</div>
</div>