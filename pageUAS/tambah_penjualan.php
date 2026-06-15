<?php
include "config/koneksi1.php";

// Membuat ID Penjualan otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(id_penjualan) AS max_id FROM tabel_penjualan");
$datakode = mysqli_fetch_assoc($carikode);

$id_penjualan = ($datakode['max_id']) ? $datakode['max_id'] + 1 : 1;

$_SESSION["KODE_PENJUALAN"] = $id_penjualan;


// Simpan Data
if (isset($_POST['simpan'])) {

    $id_penjualan      = $_POST['id_penjualan'];
    $kode_penjualan    = $_POST['kode_penjualan'];
    $id_pelanggan      = $_POST['id_pelanggan'];
    $tanggal_penjualan = $_POST['tanggal_penjualan'];
    $total_harga       = $_POST['total_harga'];
    $status            = $_POST['status'];

    $simpan = mysqli_query($koneksi, "
        INSERT INTO tabel_penjualan (
            id_penjualan,
            kode_penjualan,
            id_pelanggan,
            tanggal_penjualan,
            total_harga,
            status
        ) VALUES (
            '$id_penjualan',
            '$kode_penjualan',
            '$id_pelanggan',
            '$tanggal_penjualan',
            '$total_harga',
            '$status'
        )
    ");

    if ($simpan) {
        echo "
        <script>
            alert('Data penjualan berhasil disimpan');
            window.location='index1.php?pageUAS=penjualan_UAS';
        </script>";
    } else {
        echo "
        <div class='alert alert-danger'>
            <strong>Error Query:</strong><br>
            ".mysqli_error($koneksi)."
        </div>";
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Penjualan</h1>
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
                <label>ID Penjualan</label>
                <input type="text" class="form-control" value="<?= $id_penjualan; ?>" readonly>
                <input type="hidden" name="id_penjualan" value="<?= $id_penjualan; ?>">
            </div>

            <div class="form-group mb-3">
                <label>Kode Penjualan</label>
                <input type="text"
                       name="kode_penjualan"
                       class="form-control"
                       value="PJ<?= date('YmdHis'); ?>"
                       readonly>
            </div>

            <div class="form-group mb-3">
                <label>Pelanggan</label>
                <select name="id_pelanggan" class="form-control" required>
                    <option value="">-- Pilih Pelanggan --</option>

                    <?php
                    $pelanggan = mysqli_query($koneksi, "SELECT * FROM tabel_pelanggan");
                    while ($p = mysqli_fetch_assoc($pelanggan)) {
                    ?>
                        <option value="<?= $p['id_pelanggan']; ?>">
                            <?= $p['nama_pelanggan']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Tanggal Penjualan</label>
                <input type="date"
                       name="tanggal_penjualan"
                       class="form-control"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Total Harga</label>
                <input type="number"
                       name="total_harga"
                       class="form-control"
                       min="0"
                       required>
            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="Pending">Pending</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Batal">Batal</option>
                </select>
            </div>

            <button type="submit" name="simpan" class="btn btn-primary">
                Simpan
            </button>

            <a href="index1.php?pageUAS=penjualan_UAS" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

</div>
</div>