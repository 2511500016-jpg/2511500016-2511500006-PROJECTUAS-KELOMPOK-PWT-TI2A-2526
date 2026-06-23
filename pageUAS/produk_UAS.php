<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

        <!-- Judul Halaman -->
        <h1 class="m-0 text-dark">Data Produk</h1>

      </div>
    </div>
  </div>
</div>

<?php

// ======================================
// PROSES HAPUS DATA PRODUK
// ======================================

// Mengecek apakah parameter action ada
if(isset($_GET['action'])) {

  // Jika action = hapus
  if($_GET['action'] == "hapus") {

    // Mengambil ID produk yang dipilih
    $id = $_GET['id'];

    // Menghapus data berdasarkan id_produk
    $query = mysqli_query(
      $koneksi,
      "DELETE FROM tabel_produk WHERE id_produk='$id'"
    );

    // Jika berhasil dihapus
    if($query){

      echo '
      <div class="alert alert-warning alert-dismissible">
        Berhasil Dihapus
      </div>';

      // Kembali ke halaman data produk
      echo '<meta http-equiv="refresh"
            content="1;url=index1.php?pageUAS=produk_UAS">';
    }
  }
}
?>

<div class="content">
<div class="container-fluid">

  <!-- Card Data Produk -->
  <div class="card">

    <div class="card-body">

      <!-- Tombol Tambah Produk -->
      <a href="index1.php?pageUAS=tambah_produk"
         class="btn btn-primary btn-sm">
        Tambah Produk
      </a>

      <!-- Tabel Data Produk -->
      <table class="table table-striped">

        <thead>
          <tr>

            <!-- Nomor Urut -->
            <th>No</th>

            <!-- ID Produk -->
            <th>ID Produk</th>

            <!-- Nama Produk -->
            <th>Nama Produk</th>

            <!-- Kategori Produk -->
            <th>Kategori</th>

            <!-- Harga Produk -->
            <th>Harga</th>

            <!-- Jumlah Stok -->
            <th>Stok</th>

            <!-- Tombol Aksi -->
            <th>Aksi</th>

          </tr>
        </thead>

        <tbody>

        <?php

        // Nomor urut dimulai dari 0
        $no = 0;

        // Mengambil semua data dari tabel_produk
        $query = mysqli_query(
          $koneksi,
          "SELECT * FROM tabel_produk"
        );

        // Menampilkan data satu per satu
        while($result = mysqli_fetch_array($query)){

          // Menambah nomor urut
          $no++;
        ?>

          <tr>

            <!-- Menampilkan nomor -->
            <td><?= $no; ?></td>

            <!-- Menampilkan ID Produk -->
            <td><?= $result['id_produk']; ?></td>

            <!-- Menampilkan Nama Produk -->
            <td><?= $result['nama_produk']; ?></td>

            <!-- Menampilkan Kategori -->
            <td><?= $result['kategori']; ?></td>

            <!-- Menampilkan Harga dengan format rupiah -->
            <td>
              Rp <?= number_format(
                    $result['harga'],
                    0,
                    ',',
                    '.'
                  ); ?>
            </td>

            <!-- Menampilkan stok -->
            <td><?= $result['stok']; ?></td>

            <!-- Tombol Aksi -->
            <td>

              <!-- Tombol Hapus -->
              <a href="index1.php?pageUAS=produk_UAS&action=hapus&id=<?= $result['id_produk']; ?>"
                 onclick="return confirm('Yakin ingin menghapus data?')">

                <span class="badge badge-danger">
                  Hapus
                </span>

              </a>

              <!-- Tombol Edit -->
              <a href="index1.php?pageUAS=edit_produk&id=<?= $result['id_produk']; ?>">

                <span class="badge badge-warning">
                  Edit
                </span>

              </a>

            </td>

          </tr>

        <?php } ?>

        </tbody>

      </table>

    </div>
  </div>
</div>
</div>