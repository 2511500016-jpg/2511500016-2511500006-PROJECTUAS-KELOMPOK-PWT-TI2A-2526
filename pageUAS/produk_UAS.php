<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Produk</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
  if($_GET['action'] == "hapus") {

    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "DELETE FROM tabel_produk WHERE id_produk='$id'");

    if($query){
      echo '
      <div class="alert alert-warning alert-dismissible">
        Berhasil Dihapus
      </div>';
      echo '<meta http-equiv="refresh" content="1;url=index1.php?pageUAS=produk_UAS">';
    }
  }
}
?>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">

      <a href="index1.php?pageUAS=tambah_produk" class="btn btn-primary btn-sm">
        Tambah Produk
      </a>

      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>ID Produk</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php
        $no = 0;
        $query = mysqli_query($koneksi, "SELECT * FROM tabel_produk");

        while($result = mysqli_fetch_array($query)){
          $no++;
        ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= $result['id_produk']; ?></td>
            <td><?= $result['nama_produk']; ?></td>
            <td><?= $result['kategori']; ?></td>
            <td>Rp <?= number_format($result['harga'],0,',','.'); ?></td>
            <td><?= $result['stok']; ?></td>
            <td>

              <a href="index1.php?pageUAS=produk_UAS&action=hapus&id=<?= $result['id_produk']; ?>"
                 onclick="return confirm('Yakin ingin menghapus data?')">
                <span class="badge badge-danger">Hapus</span>
              </a>

              <a href="index1.php?pageUAS=edit_produk&id=<?= $result['id_produk']; ?>">
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