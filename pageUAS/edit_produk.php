<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Produk</h1>
            </div>
        </div>
    </div>
</div>

<?php

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM tabel_produk WHERE id_produk='$id'");

if (!$query) {
    die("Error Query : " . mysqli_error($koneksi));
}

$edit = mysqli_fetch_array($query);

if(isset($_POST['simpan'])){

    $nama_produk = $_POST['nama_produk'];
    $kategori    = $_POST['kategori'];
    $harga       = $_POST['harga'];
    $stok        = $_POST['stok'];

    $update = mysqli_query($koneksi, "
        UPDATE tabel_produk SET
        nama_produk='$nama_produk',
        kategori='$kategori',
        harga='$harga',
        stok='$stok'
        WHERE id_produk='$id'
    ");

    if($update){
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5><i class="icon fas fa-check"></i> Berhasil</h5>
            Data produk berhasil diperbarui.
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index1.php?pageUAS=produk_UAS">';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5><i class="icon fas fa-times"></i> Gagal</h5>
            Error : '.mysqli_error($koneksi).'
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">

                <form method="POST">

                    <div class="form-group">
                        <label>ID Produk</label>
                        <input
                            type="text"
                            name="id_produk"
                            value="<?= $edit['id_produk']; ?>"
                            class="form-control"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input
                            type="text"
                            name="nama_produk"
                            value="<?= $edit['nama_produk']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <input
                            type="text"
                            name="kategori"
                            value="<?= $edit['kategori']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input
                            type="number"
                            name="harga"
                            value="<?= $edit['harga']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input
                            type="number"
                            name="stok"
                            value="<?= $edit['stok']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <div class="card-footer">
                        <input
                            type="submit"
                            class="btn btn-primary"
                            name="simpan"
                            value="Simpan">

                        <a href="index1.php?pageUAS=produk_UAS"
                           class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>