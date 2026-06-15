<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Detail Penjualan</h1>
            </div>
        </div>
    </div>
</div>

<?php
$id = $_GET['id'];

$query = mysqli_query($koneksi,"
    SELECT * FROM detail_penjualan
    WHERE id_detail='$id'
");

$edit = mysqli_fetch_array($query);

// Proses Update
if(isset($_POST['simpan'])){

    $id_detail     = $_POST['id_detail'];
    $id_penjualan  = $_POST['id_penjualan'];
    $id_produk     = $_POST['id_produk'];
    $jumlah        = $_POST['jumlah'];
    $subtotal      = $_POST['subtotal'];

    $update = mysqli_query($koneksi,"
        UPDATE detail_penjualan SET
            id_penjualan='$id_penjualan',
            id_produk='$id_produk',
            jumlah='$jumlah',
            subtotal='$subtotal'
        WHERE id_detail='$id_detail'
    ");

    if($update){

        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-check"></i> Sukses</h5>
            Data Berhasil Diupdate
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index1.php?pageUAS=detail_penjualan">';

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

                <form method="POST">

                    <div class="form-group">
                        <label>ID Detail</label>
                        <input
                            type="text"
                            name="id_detail"
                            value="<?= $edit['id_detail']; ?>"
                            class="form-control"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Penjualan</label>
                        <select name="id_penjualan"
                                class="form-control"
                                required>

                            <?php
                            $penjualan = mysqli_query($koneksi,"
                                SELECT * FROM tabel_penjualan
                            ");

                            while($p = mysqli_fetch_array($penjualan)){
                            ?>

                            <option value="<?= $p['id_penjualan']; ?>"
                            <?= ($p['id_penjualan']==$edit['id_penjualan']) ? 'selected' : ''; ?>>
                                <?= $p['kode_penjualan']; ?>
                            </option>

                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Produk</label>
                        <select name="id_produk"
                                class="form-control"
                                required>

                            <?php
                            $produk = mysqli_query($koneksi,"
                                SELECT * FROM tabel_produk
                            ");

                            while($pr = mysqli_fetch_array($produk)){
                            ?>

                            <option value="<?= $pr['id_produk']; ?>"
                            <?= ($pr['id_produk']==$edit['id_produk']) ? 'selected' : ''; ?>>
                                <?= $pr['nama_produk']; ?>
                            </option>

                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input
                            type="number"
                            name="jumlah"
                            value="<?= $edit['jumlah']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Subtotal</label>
                        <input
                            type="number"
                            name="subtotal"
                            value="<?= $edit['subtotal']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <div class="card-footer">

                        <input
                            type="submit"
                            class="btn btn-primary"
                            name="simpan"
                            value="Simpan">

                        <a href="index1.php?pageUAS=detail_penjualan"
                           class="btn btn-secondary">
                           Kembali
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>
</section>