<?php

include "config/koneksi1.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Pembayaran</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
  if($_GET['action'] == "hapus") {

    $id = $_GET['id'];

    $query = mysqli_query($koneksi,"
      DELETE FROM tabel_pembayaran
      WHERE id_pembayaran='$id'
    ");

    if($query){
      echo '
      <div class="alert alert-warning alert-dismissible">
        Data Berhasil Dihapus
      </div>';

      echo '<meta http-equiv="refresh" content="1;url=index1.php?pageUAS=pembayaran_UAS">';
    }
  }
}
?>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <a href="index1.php?pageUAS=tambah_pembayaran"
         class="btn btn-primary btn-sm">
         Tambah Pembayaran
      </a>

      <br><br>

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Pembayaran</th>
            <th>ID Penjualan</th>
            <th>Metode Bayar</th>
            <th>Tanggal Bayar</th>
            <th>Status Bayar</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>

        <?php
        $no = 0;

        $query = mysqli_query($koneksi,"
          SELECT *
          FROM tabel_pembayaran tp
          INNER JOIN tabel_penjualan pj
          ON tp.id_penjualan = pj.id_penjualan
        ");

        while($result = mysqli_fetch_array($query)){
          $no++;
        ?>

          <tr>
            <td><?= $no; ?></td>
            <td><?= $result['id_pembayaran']; ?></td>
            <td><?= $result['id_penjualan']; ?></td>
            <td><?= $result['metode_bayar']; ?></td>
            <td><?= $result['tanggal_bayar']; ?></td>
            <td><?= $result['status_bayar']; ?></td>

            <td>

              <a href="index1.php?pageUAS=pembayaran_UAS&action=hapus&id=<?= $result['id_pembayaran']; ?>"
                 onclick="return confirm('Yakin ingin menghapus data?')">
                <span class="badge badge-danger">Hapus</span>
              </a>

              <a href="index1.php?pageUAS=edit_pembayaran&id=<?= $result['id_pembayaran']; ?>">
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