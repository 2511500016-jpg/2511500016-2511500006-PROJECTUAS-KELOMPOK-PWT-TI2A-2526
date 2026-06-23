<?php

// Menghubungkan file koneksi database
include "config/koneksi1.php";

?>

<!DOCTYPE html>
<html>
<head>

    <!-- Judul halaman yang tampil di tab browser -->
    <title>Cetak Laporan Penjualan</title>

    <style>

        /* Mengatur jenis huruf */
        body{
            font-family: Arial, sans-serif;
        }

        /* Judul laporan berada di tengah */
        h2{
            text-align:center;
        }

        /* Pengaturan tabel */
        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        /* Border tabel */
        table, th, td{
            border:1px solid black;
        }

        /* Jarak isi sel tabel */
        th, td{
            padding:8px;
            text-align:center;
        }

        /* Warna header tabel */
        th{
            background:#f2f2f2;
        }

    </style>

</head>

<body>

<!-- Judul laporan -->
<h2>LAPORAN PENJUALAN</h2>

<table>

    <!-- Header tabel -->
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Penjualan</th>
            <th>Pelanggan</th>
            <th>Tanggal Penjualan</th>
            <th>Total Harga</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

    <?php

    // Nomor urut
    $no = 1;

    // Variabel untuk menyimpan total seluruh penjualan
    $grand_total = 0;

    // Mengambil data penjualan dan nama pelanggan
    $query = mysqli_query($koneksi,"
        SELECT pj.*,
               pl.nama_pelanggan
        FROM tabel_penjualan pj

        /* Menggabungkan tabel pelanggan */
        LEFT JOIN tabel_pelanggan pl
        ON pj.id_pelanggan = pl.id_pelanggan

        /* Urutkan berdasarkan tanggal terbaru */
        ORDER BY pj.tanggal_penjualan DESC
    ");

    // Menampilkan data satu per satu
    while($data = mysqli_fetch_array($query)){

        // Menjumlahkan total harga ke grand total
        $grand_total += $data['total_harga'];

    ?>

        <tr>

            <!-- Nomor urut -->
            <td><?= $no++; ?></td>

            <!-- Menampilkan kode penjualan -->
            <td><?= $data['kode_penjualan']; ?></td>

            <!-- Menampilkan nama pelanggan -->
            <td><?= $data['nama_pelanggan']; ?></td>

            <!-- Menampilkan tanggal penjualan -->
            <td>
                <?= date(
                    'd-m-Y',
                    strtotime($data['tanggal_penjualan'])
                ); ?>
            </td>

            <!-- Menampilkan total harga format rupiah -->
            <td>
                Rp <?= number_format(
                        $data['total_harga'],
                        0,
                        ',',
                        '.'
                    ); ?>
            </td>

            <!-- Menampilkan status penjualan -->
            <td><?= $data['status']; ?></td>

        </tr>

    <?php } ?>

        <!-- Menampilkan jumlah seluruh penjualan -->
        <tr>

            <th colspan="4">
                GRAND TOTAL
            </th>

            <th colspan="2">

                Rp <?= number_format(
                        $grand_total,
                        0,
                        ',',
                        '.'
                    ); ?>

            </th>

        </tr>

    </tbody>

</table>

<br><br>

<!-- Tabel tanda tangan -->
<table width="100%" border="0" style="border:none;">

    <tr>

        <!-- Kolom kosong sebelah kiri -->
        <td width="70%" style="border:none;"></td>

        <!-- Kolom tanda tangan -->
        <td align="center" style="border:none;">

            <!-- Menampilkan tanggal cetak -->
            Pangkalpinang,
            <?= date('d-m-Y'); ?>

            <br><br><br><br>

            <!-- Tempat tanda tangan -->
            ______________________

            <br>

            <!-- Nama penandatangan -->
            Admin

         </td>
    </tr>
    <a href="index1.php?pageUAS=cetak_laporan_penjualan" target="_blank" class="btn btn-success">
        <i class="fas fa-print"></i> Cetak Laporan
    </a>
</table>

</body>
</html>