<?php

include "config/koneksi1.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Penjualan</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
  if($_GET['action'] == "hapus") {

    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "
      DELETE FROM penjualan
      WHERE id_penjualan='$id'
    ");

    if($query){
      echo '
      <div class="alert alert-warning alert-dismissible">
        Data Berhasil Dihapus
      </div>';

      echo '<meta http-equiv="refresh" content="1;url=index.php?pageUAS=penjualan_UAS">';
    }
  }
}
?>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <a href="index1.php?pageUAS=tambah_penjualan"
         class="btn btn-primary btn-sm">
         Tambah Penjualan
      </a>

      <br><br>

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Penjualan</th>
            <th>Pelanggan</th>
            <th>Tanggal Penjualan</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>

        <?php
        $no = 0;

        $query = mysqli_query($koneksi,"
          SELECT *
          FROM tabel_penjualan p
          INNER JOIN tabel_pelanggan pl
          ON p.id_pelanggan = pl.id_pelanggan

        ");

        while($result = mysqli_fetch_array($query)){
          $no++;
        ?>

          <tr>
            <td><?= $no; ?></td>
            <td><?= $result['kode_penjualan']; ?></td>
            <td><?= $result['nama_pelanggan']; ?></td>
            <td><?= $result['tanggal_penjualan']; ?></td>
            <td>Rp <?= number_format($result['total_harga']); ?></td>
            <td><?= $result['status']; ?></td>

            <td>

              <a href="index1.php?pageUAS=penjualan_UAS&action=hapus&id=<?= $result['id_penjualan']; ?>"
                 onclick="return confirm('Yakin ingin menghapus data?')">
                <span class="badge badge-danger">Hapus</span>
              </a>

              <a href="index1.php?pageUAS=edit_penjualan&id=<?= $result['id_penjualan']; ?>">
                <span class="badge badge-warning">Edit</span>
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