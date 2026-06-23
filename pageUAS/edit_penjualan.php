<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                <!-- Judul Halaman -->
                <h1 class="m-0 text-dark">Edit Penjualan</h1>

            </div>
        </div>
    </div>
</div>

<?php

// ======================================
// MENGAMBIL ID PENJUALAN DARI URL
// ======================================

// Contoh:
// index1.php?pageUAS=edit_penjualan&id=1
$id = $_GET['id'];


// ======================================
// MENAMPILKAN DATA PENJUALAN YANG AKAN DIEDIT
// ======================================

$query = mysqli_query($koneksi,"
    SELECT * FROM tabel_penjualan
    WHERE id_penjualan='$id'
");

// Mengambil data hasil query
$edit = mysqli_fetch_array($query);


// ======================================
// PROSES UPDATE DATA
// ======================================

// Jika tombol Simpan ditekan
if(isset($_POST['simpan'])){

    // Mengambil data dari form
    $id_penjualan      = $_POST['id_penjualan'];
    $kode_penjualan    = $_POST['kode_penjualan'];
    $id_pelanggan      = $_POST['id_pelanggan'];
    $tanggal_penjualan = $_POST['tanggal_penjualan'];
    $total_harga       = $_POST['total_harga'];
    $status            = $_POST['status'];

    // Query update data
    $update = mysqli_query($koneksi,"
        UPDATE tabel_penjualan SET

            kode_penjualan='$kode_penjualan',
            id_pelanggan='$id_pelanggan',
            tanggal_penjualan='$tanggal_penjualan',
            total_harga='$total_harga',
            status='$status'

        WHERE id_penjualan='$id_penjualan'
    ");

    // Jika berhasil update
    if($update){

        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button"
                    class="close"
                    data-dismiss="alert">X</button>

            <h5>
                <i class="icon fas fa-check"></i>
                Sukses
            </h5>

            Data Berhasil Diupdate
        </div>';

        // Redirect ke halaman data penjualan
        echo '<meta http-equiv="refresh"
              content="1;url=index1.php?pageUAS=penjualan_UAS">';

    }else{

        // Jika gagal update
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button"
                    class="close"
                    data-dismiss="alert">X</button>

            <h5>
                <i class="icon fas fa-times"></i>
                Error
            </h5>

            Data Gagal Diupdate
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">

        <!-- Card Form Edit -->
        <div class="card">

            <div class="card-body p-2">

                <!-- Form Edit Penjualan -->
                <form method="POST" action="">

                    <!-- ID Penjualan -->
                    <div class="form-group">
                        <label>ID Penjualan</label>

                        <input
                            type="text"
                            name="id_penjualan"
                            value="<?= $edit['id_penjualan']; ?>"
                            class="form-control"
                            readonly>

                        <!-- readonly = tidak bisa diubah -->
                    </div>

                    <!-- Kode Penjualan -->
                    <div class="form-group">
                        <label>Kode Penjualan</label>

                        <input
                            type="text"
                            name="kode_penjualan"
                            value="<?= $edit['kode_penjualan']; ?>"
                            class="form-control"
                            readonly>

                        <!-- readonly = tidak bisa diubah -->
                    </div>

                    <!-- Pilih Pelanggan -->
                    <div class="form-group">
                        <label>Pelanggan</label>

                        <select
                            name="id_pelanggan"
                            class="form-control"
                            required>

                            <?php

                            // Mengambil data pelanggan
                            $pelanggan = mysqli_query($koneksi,"
                                SELECT * FROM tabel_pelanggan
                            ");

                            while($p = mysqli_fetch_array($pelanggan)){
                            ?>

                            <option
                                value="<?= $p['id_pelanggan']; ?>"

                                <?= ($p['id_pelanggan']
                                    == $edit['id_pelanggan'])
                                    ? 'selected'
                                    : ''; ?>>

                                <?= $p['nama_pelanggan']; ?>

                            </option>

                            <?php } ?>

                        </select>

                    </div>

                    <!-- Tanggal Penjualan -->
                    <div class="form-group">
                        <label>Tanggal Penjualan</label>

                        <input
                            type="date"
                            name="tanggal_penjualan"
                            value="<?= $edit['tanggal_penjualan']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <!-- Total Harga -->
                    <div class="form-group">
                        <label>Total Harga</label>

                        <input
                            type="number"
                            name="total_harga"
                            value="<?= $edit['total_harga']; ?>"
                            class="form-control"
                            required>
                    </div>

                    <!-- Status Penjualan -->
                    <div class="form-group">
                        <label>Status</label>

                        <select
                            name="status"
                            class="form-control"
                            required>

                            <!-- Jika status saat ini Pending maka dipilih otomatis -->
                            <option value="Pending"
                            <?= ($edit['status']=='Pending')
                            ? 'selected' : ''; ?>>
                                Pending
                            </option>

                            <!-- Jika status saat ini Diproses -->
                            <option value="Diproses"
                            <?= ($edit['status']=='Diproses')
                            ? 'selected' : ''; ?>>
                                Diproses
                            </option>

                            <!-- Jika status saat ini Selesai -->
                            <option value="Selesai"
                            <?= ($edit['status']=='Selesai')
                            ? 'selected' : ''; ?>>
                                Selesai
                            </option>

                            <!-- Jika status saat ini Batal -->
                            <option value="Batal"
                            <?= ($edit['status']=='Batal')
                            ? 'selected' : ''; ?>>
                                Batal
                            </option>

                        </select>

                    </div>

                    <!-- Tombol Aksi -->
                    <div class="card-footer">

                        <!-- Tombol Simpan -->
                        <input
                            type="submit"
                            class="btn btn-primary"
                            name="simpan"
                            value="Simpan">

                        <!-- Tombol Kembali -->
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