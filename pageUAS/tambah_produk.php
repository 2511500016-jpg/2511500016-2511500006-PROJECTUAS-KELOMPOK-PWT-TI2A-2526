<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">TAMBAH PRODUK</h1>
            </div>
        </div>
    </div>
</div>

<?php
// Kode otomatis ID Produk
$carikode = mysqli_query($koneksi, "SELECT MAX(id_produk) FROM tabel_produk") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if($datakode[0]){
    $kode = (int)$datakode[0] + 1;
    $hasilkode = $kode;
}else{
    $hasilkode = 1;
}

if(isset($_POST['tambah'])){

    $id_produk   = mysqli_real_escape_string($koneksi,$_POST['id_produk']);
    $nama_produk = mysqli_real_escape_string($koneksi,$_POST['nama_produk']);
    $kategori    = mysqli_real_escape_string($koneksi,$_POST['kategori']);
    $harga       = mysqli_real_escape_string($koneksi,$_POST['harga']);
    $stok        = mysqli_real_escape_string($koneksi,$_POST['stok']);

    $insert = mysqli_query($koneksi,"
        INSERT INTO tabel_produk
        (id_produk,nama_produk,kategori,harga,stok)
        VALUES
        ('$id_produk','$nama_produk','$kategori','$harga','$stok')
    ");

    if($insert){
        echo '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h5><i class="icon fas fa-check"></i> Sukses!</h5>
            Data Produk Berhasil Disimpan
        </div>';

        echo '<script>
            setTimeout(function(){
                window.location="index1.php?pageUAS=produk_UAS";
            },1000);
        </script>';
    }else{
        echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
            Data Gagal Disimpan
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Tambahkan Data Produk</h3>
            </div>

            <div class="card-body p-2">

                <form method="POST" action="">

                    <div class="form-group">
                        <label>ID Produk</label>
                        <input type="text"
                               name="id_produk"
                               value="<?= $hasilkode; ?>"
                               class="form-control"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text"
                               name="nama_produk"
                               class="form-control"
                               placeholder="Masukkan Nama Produk"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text"
                               name="kategori"
                               class="form-control"
                               placeholder="Masukkan Kategori Produk"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number"
                               name="harga"
                               class="form-control"
                               placeholder="Masukkan Harga Produk"
                               required>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number"
                               name="stok"
                               class="form-control"
                               placeholder="Masukkan Jumlah Stok"
                               required>
                    </div>

                    <div class="card-footer">
                        <input type="submit"
                               class="btn btn-primary"
                               name="tambah"
                               value="Simpan">

                        <a href="index1.php?pageUAS=produk_UAS"
                           class="btn btn-default">
                           Kembali
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</section>