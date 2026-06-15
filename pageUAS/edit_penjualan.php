<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Penjualan</h1>
            </div>
        </div>
    </div>
</div>

<?php
$id = $_GET['id'];

$query = mysqli_query($koneksi, "
    SELECT * FROM tabel_penjualan
    WHERE id_penjualan='$id'
");

$edit = mysqli_fetch_array($query);

// Proses Update
if(isset($_POST['simpan'])){

    $id_penjualan      = $_POST['id_penjualan'];
    $kode_penjualan    = $_POST['kode_penjualan'];
    $id_pelanggan      = $_POST['id_pelanggan'];
    $tanggal_penjualan = $_POST['tanggal_penjualan'];
    $total_harga       = $_POST['total_harga'];
    $status            = $_POST['status'];

    $update = mysqli_query($koneksi, "
        UPDATE tabel_penjualan SET
            kode_penjualan='$kode_penjualan',
            id_pelanggan='$id_pelanggan',
            tanggal_penjualan='$tanggal_penjualan',
            total_harga='$total_harga',
            status='$status'
        WHERE id_penjualan='$id_penjualan'
    ");

    if($update){
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">X</button>
            <h5><i class="icon fas fa-check"></i> Sukses</h5>
            Data Berhasil Diupdate
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index1.php?pageUAS=penjualan_UAS">';
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
                        <label>ID Penjualan</label>
                        <input
                            type="text"
                            name="id_penjualan"
                            value="<?= $edit['id_penjualan']; ?>"
                            class="form-control"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Kode Penjualan</label>
                        <input
                            type="text"
                            name="kode_penjualan"
                            value="<?= $edit['kode_penjualan']; ?>"
                            class="form-control"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label>Pelanggan</label>
                        <select name="id_pelanggan" class="form-control" required>

                            <?php
                            $pelanggan = mysqli_query($koneksi,"
                                SELECT * FROM tabel_pelanggan
                            ");

                            while($p = mysqli_fetch_array($pelanggan)){
                            ?>

                            <option value="<?= $p['id_pelanggan']; ?>"
                            <?= ($p['id_pelanggan'] == $edit['id_pelanggan']) ? 'selected' : ''; ?>>
                                <?= $p['nama_pelanggan']; ?>
                            </option>

                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Penjualan</label>
                        <input
                            type="date"
                            name="tanggal_penjualan"
                            value="<?= $edit['tanggal_penjualan']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Total Harga</label>
                        <input
                            type="number"
                            name="total_harga"
                            value="<?= $edit['total_harga']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>

                            <option value="Pending"
                            <?= ($edit['status']=='Pending') ? 'selected' : ''; ?>>
                                Pending
                            </option>

                            <option value="Diproses"
                            <?= ($edit['status']=='Diproses') ? 'selected' : ''; ?>>
                                Diproses
                            </option>

                            <option value="Selesai"
                            <?= ($edit['status']=='Selesai') ? 'selected' : ''; ?>>
                                Selesai
                            </option>

                            <option value="Batal"
                            <?= ($edit['status']=='Batal') ? 'selected' : ''; ?>>
                                Batal
                            </option>

                        </select>
                    </div>

                    <div class="card-footer">
                        <input
                            type="submit"
                            class="btn btn-primary"
                            name="simpan"
                            value="Simpan">

                        <a href="index1.php?pageUAS=penjualan_UAS"
                           class="btn btn-secondary">
                           Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>