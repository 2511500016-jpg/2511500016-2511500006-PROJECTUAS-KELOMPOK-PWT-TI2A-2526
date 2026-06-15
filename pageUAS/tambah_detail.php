<?php
include "config/koneksi1.php";

// Membuat ID Detail otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(id_detail) AS max_id FROM detail_penjualan");
$datakode = mysqli_fetch_assoc($carikode);

$id_detail = ($datakode['max_id']) ? $datakode['max_id'] + 1 : 1;

// Simpan Data
if(isset($_POST['simpan'])){

    $id_detail     = $_POST['id_detail'];
    $id_penjualan  = $_POST['id_penjualan'];
    $id_produk     = $_POST['id_produk'];
    $jumlah        = $_POST['jumlah'];
    $subtotal      = $_POST['subtotal'];

    $simpan = mysqli_query($koneksi,"
        INSERT INTO detail_penjualan(
            id_detail,
            id_penjualan,
            id_produk,
            jumlah,
            subtotal
        ) VALUES (
            '$id_detail',
            '$id_penjualan',
            '$id_produk',
            '$jumlah',
            '$subtotal'
        )
    ");

    if($simpan){
        echo "
        <script>
            alert('Data detail penjualan berhasil disimpan');
            window.location='index1.php?pageUAS=detail_penjualan';
        </script>";
    }else{
        echo "
        <div class='alert alert-danger'>
            ".mysqli_error($koneksi)."
        </div>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Detail Penjualan</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
<div class="container-fluid">

<div class="card">
<div class="card-body">

<form method="POST">

    <div class="form-group mb-3">
        <label>ID Detail</label>
        <input type="text"
               class="form-control"
               value="<?= $id_detail; ?>"
               readonly>

        <input type="hidden"
               name="id_detail"
               value="<?= $id_detail; ?>">
    </div>

    <div class="form-group mb-3">
        <label>Penjualan</label>
        <select name="id_penjualan" class="form-control" required>
            <option value="">-- Pilih Penjualan --</option>

            <?php
            $penjualan = mysqli_query($koneksi,"
                SELECT * FROM tabel_penjualan
            ");

            while($p = mysqli_fetch_assoc($penjualan)){
            ?>
            <option value="<?= $p['id_penjualan']; ?>">
                <?= $p['kode_penjualan']; ?>
            </option>
            <?php } ?>

        </select>
    </div>

    <div class="form-group mb-3">
        <label>Produk</label>
        <select name="id_produk" class="form-control" required>
            <option value="">-- Pilih Produk --</option>

            <?php
            $produk = mysqli_query($koneksi,"
                SELECT * FROM tabel_produk
            ");

            while($pr = mysqli_fetch_assoc($produk)){
            ?>
            <option value="<?= $pr['id_produk']; ?>">
                <?= $pr['nama_produk']; ?>
            </option>
            <?php } ?>

        </select>
    </div>

    <div class="form-group mb-3">
        <label>Jumlah</label>
        <input type="number"
               name="jumlah"
               class="form-control"
               min="1"
               required>
    </div>

    <div class="form-group mb-3">
        <label>Subtotal</label>
        <input type="number"
               name="subtotal"
               class="form-control"
               min="0"
               required>
    </div>

    <button type="submit"
            name="simpan"
            class="btn btn-primary">
        Simpan
    </button>

    <a href="index1.php?pageUAS=detail_penjualan"
       class="btn btn-secondary">
       Kembali
    </a>

</form>

</div>
</div>

</div>
</div>