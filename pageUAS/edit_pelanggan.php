<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Pelanggan</h1>
            </div>
        </div>
    </div>
</div>

<?php
$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM tabel_pelanggan WHERE id_pelanggan='$id'");
$edit  = mysqli_fetch_array($query);

// Proses Update
if(isset($_POST['simpan'])){

    $id_pelanggan   = $_POST['id_pelanggan'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $alamat         = $_POST['alamat'];
    $telepon        = $_POST['telepon'];

    $update = mysqli_query($koneksi, "UPDATE tabel_pelanggan SET
        nama_pelanggan='$nama_pelanggan',
        alamat='$alamat',
        telepon='$telepon'
        WHERE id_pelanggan='$id_pelanggan'
    ");

    if($update){
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-check"></i> Sukses</h5>
            Data Berhasil Diupdate
        </div>';
        echo '<meta http-equiv="refresh" content="1;url=index1.php?pageUAS=pelanggan_UAS">';
    }else{
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-times"></i> Error</h5>
            Data Gagal Diupdate
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body p-2">

                <form method="POST" action="">

                    <div class="form-group">
                        <label>ID Pelanggan</label>
                        <input
                            type="text"
                            name="id_pelanggan"
                            value="<?= $edit['id_pelanggan']; ?>"
                            class="form-control"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input
                            type="text"
                            name="nama_pelanggan"
                            value="<?= $edit['nama_pelanggan']; ?>"
                            class="form-control"
                            placeholder="Nama Pelanggan"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea
                            name="alamat"
                            class="form-control"
                            rows="3"
                            required><?= $edit['alamat']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Telepon</label>
                        <input
                            type="text"
                            name="telepon"
                            value="<?= $edit['telepon']; ?>"
                            class="form-control"
                            placeholder="Nomor Telepon"
                            required>
                    </div>

                    <div class="card-footer">
                        <input
                            type="submit"
                            class="btn btn-primary"
                            name="simpan"
                            value="Simpan">

                        <a href="index1.php?pageUAS=pelanggan_UAS"
                           class="btn btn-secondary">
                           Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>