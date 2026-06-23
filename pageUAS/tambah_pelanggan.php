<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

        <!-- Judul halaman -->
        <h1 class="m-0 text-dark">Tambah Pelanggan</h1>

      </div>
    </div>
  </div>
</div>

<?php

// ======================================
// MEMBUAT ID PELANGGAN OTOMATIS
// ======================================

// Mengambil ID pelanggan terbesar dari tabel_pelanggan
$carikode = mysqli_query($koneksi,
"SELECT MAX(id_pelanggan) FROM tabel_pelanggan")
or die(mysqli_error($koneksi));

// Mengambil hasil query
$datakode = mysqli_fetch_array($carikode);

// Jika data pelanggan sudah ada
if($datakode && $datakode[0] != null){

    // Mengubah nilai menjadi integer
    $nilaikode = (int)$datakode[0];

    // Menambah 1 dari ID terakhir
    $kode = $nilaikode + 1;

    // Membuat format 3 digit
    // contoh : 1 menjadi 001
    //           2 menjadi 002
    //          10 menjadi 010
    $hasilkode = str_pad($kode, 3, "0", STR_PAD_LEFT);

}else{

    // Jika belum ada data pelanggan
    // maka ID pertama adalah 001
    $hasilkode = "001";
}

// Menyimpan ID otomatis ke session
$_SESSION["KODE"] = $hasilkode;


// ======================================
// PROSES SIMPAN DATA
// ======================================

// Jika tombol Simpan ditekan
if(isset($_POST['tambah'])){

    // Mengambil data dari form
    $id_pelanggan =
    mysqli_real_escape_string($koneksi,$_POST['id_pelanggan']);

    $nama_pelanggan =
    mysqli_real_escape_string($koneksi,$_POST['nama_pelanggan']);

    $alamat =
    mysqli_real_escape_string($koneksi,$_POST['alamat']);

    $telepon =
    mysqli_real_escape_string($koneksi,$_POST['telepon']);

    // Menyimpan data ke tabel_pelanggan
    $insert = mysqli_query($koneksi,"
    INSERT INTO tabel_pelanggan
    VALUES(
        '$id_pelanggan',
        '$nama_pelanggan',
        '$alamat',
        '$telepon'
    )");

    // Jika berhasil disimpan
    if($insert){

        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button"
                    class="close"
                    data-dismiss="alert">x</button>

            <h5>
              <i class="icon fas fa-check"></i>
              Sukses
            </h5>

            Data Pelanggan Berhasil Disimpan
        </div>

        <!-- Pindah ke halaman data pelanggan -->
        <meta http-equiv="refresh"
              content="1;url=index1.php?pageUAS=pelanggan_UAS">
        ';

    }else{

        // Jika gagal disimpan
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button"
                    class="close"
                    data-dismiss="alert">x</button>

            <h5>
              <i class="icon fas fa-times"></i>
              Error
            </h5>

            Gagal Menyimpan Data
        </div>';
    }
}
?>

<section class="content">
  <div class="container-fluid">

    <!-- Card Form Tambah Pelanggan -->
    <div class="card">

      <div class="card-body">

        <!-- Form Input Data Pelanggan -->
        <form method="POST" action="">

          <!-- ID Pelanggan Otomatis -->
          <div class="form-group">
            <label>ID Pelanggan</label>

            <input type="text"
                   name="id_pelanggan"
                   value="<?= $hasilkode; ?>"
                   class="form-control"
                   readonly>
          </div>

          <!-- Input Nama Pelanggan -->
          <div class="form-group">
            <label>Nama Pelanggan</label>

            <input type="text"
                   name="nama_pelanggan"
                   class="form-control"
                   placeholder="Masukkan Nama Pelanggan"
                   required>
          </div>

          <!-- Input Alamat -->
          <div class="form-group">
            <label>Alamat</label>

            <textarea name="alamat"
                      class="form-control"
                      placeholder="Masukkan Alamat"
                      required>
            </textarea>
          </div>

          <!-- Input Nomor Telepon -->
          <div class="form-group">
            <label>Telepon</label>

            <input type="text"
                   name="telepon"
                   class="form-control"
                   placeholder="Masukkan Nomor Telepon"
                   required>
          </div>

          <!-- Tombol Simpan dan Kembali -->
          <div class="card-footer">

            <!-- Tombol Simpan -->
            <input type="submit"
                   name="tambah"
                   value="Simpan"
                   class="btn btn-primary">

            <!-- Tombol Kembali -->
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