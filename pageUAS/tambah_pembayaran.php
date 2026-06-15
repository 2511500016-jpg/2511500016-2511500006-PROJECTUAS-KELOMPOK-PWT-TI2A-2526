<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Pembayaran</h1>
      </div>
    </div>
  </div>
</div>

<?php

// Membuat ID Pembayaran Otomatis
$carikode = mysqli_query($koneksi,"SELECT MAX(id_pembayaran) FROM tabel_pembayaran") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if($datakode && $datakode[0] != null){
    $nilaikode = (int)$datakode[0];
    $kode = $nilaikode + 1;
    $hasilkode = str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "001";
}

$_SESSION["KODE"] = $hasilkode;

// Proses Simpan
if(isset($_POST['tambah'])){

    $id_pembayaran = mysqli_real_escape_string($koneksi,$_POST['id_pembayaran']);
    $id_penjualan  = mysqli_real_escape_string($koneksi,$_POST['id_penjualan']);
    $metode_bayar  = mysqli_real_escape_string($koneksi,$_POST['metode_bayar']);
    $tanggal_bayar = mysqli_real_escape_string($koneksi,$_POST['tanggal_bayar']);
    $status_bayar  = mysqli_real_escape_string($koneksi,$_POST['status_bayar']);

    $insert = mysqli_query($koneksi,"
        INSERT INTO tabel_pembayaran
        VALUES(
            '$id_pembayaran',
            '$id_penjualan',
            '$metode_bayar',
            '$tanggal_bayar',
            '$status_bayar'
        )
    ");

    if($insert){
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <h5><i class="icon fas fa-check"></i> Sukses</h5>
            Data Pembayaran Berhasil Disimpan
        </div>
        <meta http-equiv="refresh" content="1;url=index1.php?pageUAS=pembayaran_UAS">';
    }else{
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <h5><i class="icon fas fa-times"></i> Error</h5>
            Gagal Menyimpan Data
        </div>';
    }
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">

        <form method="POST" action="">

          <div class="form-group">
            <label>ID Pembayaran</label>
            <input type="text"
                   name="id_pembayaran"
                   value="<?= $hasilkode; ?>"
                   class="form-control"
                   readonly>
          </div>

          <div class="form-group">
            <label>ID Penjualan</label>
            <select name="id_penjualan" class="form-control" required>
              <option value="">-- Pilih Penjualan --</option>
              <?php
              $penjualan = mysqli_query($koneksi,"SELECT * FROM detail_penjualan");
              while($p = mysqli_fetch_array($penjualan)){
              ?>
                <option value="<?= $p['id_penjualan']; ?>">
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
                   placeholder="Contoh: Tunai, Transfer, QRIS"
                   required>
          </div>

          <div class="form-group">
            <label>Tanggal Bayar</label>
            <input type="date"
                   name="tanggal_bayar"
                   class="form-control"
                   required>
          </div>

          <div class="form-group">
            <label>Status Bayar</label>
            <select name="status_bayar" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="Lunas">Lunas</option>
              <option value="Belum Lunas">Belum Lunas</option>
            </select>
          </div>

          <div class="card-footer">
            <input type="submit"
                   name="tambah"
                   value="Simpan"
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