<?php

// Menghubungkan file koneksi database
include "config/koneksi1.php";

?>

<!DOCTYPE html>
<html>
<head>

    <!-- Judul halaman -->
    <title>Cetak Laporan Penjualan</title>

    <style>

        /* Mengatur jenis huruf */
        body{
            font-family: Arial, sans-serif;
        }

        /* Judul laporan rata tengah */
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

        /* Jarak isi tabel */
        th, td{
            padding:8px;
            text-align:center;
        }

        /* Warna header tabel */
        th{
            background:#f2f2f2;
        }

        /* Style tombol cetak */
        .btn-print{
            background:#007bff;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:5px;
            cursor:pointer;
            font-size:14px;
        }

        /* Efek saat mouse diarahkan ke tombol */
        .btn-print:hover{
            background:#0056b3;
        }

        /* Saat dicetak tombol tidak ditampilkan */
        @media print{
            .btn-print{
                display:none;
            }
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

    // Nomor urut data
    $no = 1;

    // Variabel untuk menyimpan total seluruh penjualan
    $grand_total = 0;

    // Mengambil data penjualan dan nama pelanggan
    $query = mysqli_query($koneksi,"
        SELECT pj.*,
               pl.nama_pelanggan
        FROM tabel_penjualan pj

        LEFT JOIN tabel_pelanggan pl
        ON pj.id_pelanggan = pl.id_pelanggan

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

            <!-- Kode Penjualan -->
            <td><?= $data['kode_penjualan']; ?></td>

            <!-- Nama Pelanggan -->
            <td><?= $data['nama_pelanggan']; ?></td>

            <!-- Format tanggal menjadi dd-mm-yyyy -->
            <td>
                <?= date('d-m-Y',
                    strtotime($data['tanggal_penjualan'])); ?>
            </td>

            <!-- Format rupiah -->
            <td>
                Rp <?= number_format(
                        $data['total_harga'],
                        0,
                        ',',
                        '.'
                    ); ?>
            </td>

            <!-- Status Penjualan -->
            <td><?= $data['status']; ?></td>

        </tr>

    <?php } ?>

        <!-- Menampilkan Grand Total -->
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

        <!-- Kolom kosong -->
        <td width="70%" style="border:none;"></td>

        <!-- Bagian tanda tangan -->
        <td align="center" style="border:none;">

            <!-- Menampilkan tanggal hari ini -->
            Pangkalpinang,
            <?= date('d-m-Y'); ?>

            <br><br><br><br>

            <!-- Tempat tanda tangan -->
            ______________________

            <br>

            Admin

        </td>

    </tr>

</table>

<!-- Membuka dialog cetak otomatis -->
<script>

    // Saat halaman dibuka langsung tampil print
    window.print();

</script>

</body>
</html>