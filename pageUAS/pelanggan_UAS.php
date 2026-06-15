<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Pelanggan</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
  if($_GET['action'] == "hapus") {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "DELETE FROM tabel_pelanggan WHERE id_pelanggan='$id'");

    if($query){
      echo '
      <div class="alert alert-warning alert-dismissible">
        Data Berhasil Dihapus
      </div>';
      echo '<meta http-equiv="refresh" content="1;url=index1.php?pageUAS=pelanggan_UAS">';
    }
  }
}
?>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <a href="index1.php?pageUAS=tambah_pelanggan" class="btn btn-primary btn-sm">
        Tambah Pelanggan
      </a>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php
        $no = 0;
        $query = mysqli_query($koneksi, "SELECT * FROM tabel_pelanggan");

        while($result = mysqli_fetch_array($query)){
          $no++;
        ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= $result['id_pelanggan']; ?></td>
            <td><?= $result['nama_pelanggan']; ?></td>
            <td><?= $result['alamat']; ?></td>
            <td><?= $result['telepon']; ?></td>
            <td>

              <a href="index1.php?pageUAS=pelanggan_UAS&action=hapus&id=<?= $result['id_pelanggan']; ?>"
                 onclick="return confirm('Yakin ingin menghapus data ini?')">
                <span class="badge badge-danger">Hapus</span>
              </a>

              <a href="index1.php?pageUAS=edit_pelanggan&id=<?= $result['id_pelanggan']; ?>">
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