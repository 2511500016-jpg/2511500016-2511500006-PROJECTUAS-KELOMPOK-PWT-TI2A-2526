<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Pembayaran</h1>
            </div>
        </div>
    </div>
</div>

<?php

$id = $_GET['id'];

$query = mysqli_query($koneksi,"
    SELECT * FROM tabel_pembayaran
    WHERE id_pembayaran='$id'
");

$data = mysqli_fetch_array($query);

if(isset($_POST['edit'])){

    $id_penjualan  = mysqli_real_escape_string($koneksi,$_POST['id_penjualan']);
    $metode_bayar  = mysqli_real_escape_string($koneksi,$_POST['metode_bayar']);
    $tanggal_bayar = mysqli_real_escape_string($koneksi,$_POST['tanggal_bayar']);
    $status_bayar  = mysqli_real_escape_string($koneksi,$_POST['status_bayar']);

    $update = mysqli_query($koneksi,"
        UPDATE tabel_pembayaran SET
            id_penjualan='$id_penjualan',
            metode_bayar='$metode_bayar',
            tanggal_bayar='$tanggal_bayar',
            status_bayar='$status_bayar'
        WHERE id_pembayaran='$id'
    ");

    if($update){
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <h5><i class="icon fas fa-check"></i> Sukses</h5>
            Data Pembayaran Berhasil Diubah
        </div>

        <meta http-equiv="refresh" content="1;url=index1.php?pageUAS=pembayaran_UAS">
        ';
    }else{
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <h5><i class="icon fas fa-times"></i> Error</h5>
            Gagal Mengubah Data
        </div>
        ';
    }
}

?>

<section class="content">
<div class="container-fluid">
<div class="card">
<div class="card-body">

<form method="POST">

    <div class="form-group">
        <label>ID Pembayaran</label>
        <input type="text"
               class="form-control"
               value="<?= $data['id_pembayaran']; ?>"
               readonly>
    </div>

    <div class="form-group">
        <label>ID Penjualan</label>
        <select name="id_penjualan" class="form-control" required>

            <?php
            $penjualan = mysqli_query($koneksi,"
                SELECT * FROM tabel_penjualan
            ");

            while($p = mysqli_fetch_array($penjualan)){
            ?>

            <option value="<?= $p['id_penjualan']; ?>"
            <?php
            if($p['id_penjualan']==$data['id_penjualan']){
                echo "selected";
            }
            ?>>
                <?= $p['id_penjualan']; ?>
            </option>

            <?php } ?>

        </select>
    </div>

    <div class="form-group">
        <label>Metode Bayar</label>
        <input type="text"
               name="metode_bayar"
               class="form-control"
               value="<?= $data['metode_bayar']; ?>"
               required>
    </div>

    <div class="form-group">
        <label>Tanggal Bayar</label>
        <input type="date"
               name="tanggal_bayar"
               class="form-control"
               value="<?= $data['tanggal_bayar']; ?>"
               required>
    </div>

    <div class="form-group">
        <label>Status Bayar</label>
        <select name="status_bayar" class="form-control" required>

            <option value="Lunas"
            <?= ($data['status_bayar']=='Lunas') ? 'selected' : ''; ?>>
                Lunas
            </option>

            <option value="Belum Lunas"
            <?= ($data['status_bayar']=='Belum Lunas') ? 'selected' : ''; ?>>
                Belum Lunas
            </option>

        </select>
    </div>

    <div class="card-footer">

        <input type="submit"
               name="edit"
               value="Update"
               class="btn btn-primary">

        <a href="index1.php?pageUAS=pembayaran_UAS"
           class="btn btn-secondary">
           Kembali
        </a>

    </div>

</form>

</div>
</div>
</div>
</section>