<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Pelanggan</h1>
      </div>
    </div>
  </div>
</div>

<?php

// Membuat ID Pelanggan Otomatis
$carikode = mysqli_query($koneksi,"SELECT MAX(id_pelanggan) FROM tabel_pelanggan") or die(mysqli_error($koneksi));
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

    $id_pelanggan   = mysqli_real_escape_string($koneksi,$_POST['id_pelanggan']);
    $nama_pelanggan = mysqli_real_escape_string($koneksi,$_POST['nama_pelanggan']);
    $alamat         = mysqli_real_escape_string($koneksi,$_POST['alamat']);
    $telepon        = mysqli_real_escape_string($koneksi,$_POST['telepon']);

    $insert = mysqli_query($koneksi,"INSERT INTO tabel_pelanggan
    VALUES('$id_pelanggan','$nama_pelanggan','$alamat','$telepon')");

    if($insert){
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <h5><i class="icon fas fa-check"></i> Sukses</h5>
            Data Pelanggan Berhasil Disimpan
        </div>
        <meta http-equiv="refresh" content="1;url=index1.php?pageUAS=pelanggan_UAS">';
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
            <label>ID Pelanggan</label>
            <input type="text" name="id_pelanggan"
                   value="<?= $hasilkode; ?>"
                   class="form-control" readonly>
          </div>

          <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan"
                   class="form-control"
                   placeholder="Masukkan Nama Pelanggan"
                   required>
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat"
                      class="form-control"
                      placeholder="Masukkan Alamat"
                      required></textarea>
          </div>

          <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telepon"
                   class="form-control"
                   placeholder="Masukkan Nomor Telepon"
                   required>
          </div>

          <div class="card-footer">
            <input type="submit"
                   name="tambah"
                   value="Simpan"
                   class="btn btn-primary">
            <a href="index1.php?pageUAS=pelanggan_UAS"
               class="btn btn-secondary">Kembali</a>
          </div>

        </form>

      </div>
    </div>
  </div>
</section>