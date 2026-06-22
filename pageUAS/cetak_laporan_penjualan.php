<?php
include "config/koneksi1.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Penjualan</title>

    <style>
        body{
            font-family: Arial, sans-serif;
        }

        h2{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:8px;
            text-align:center;
        }

        th{
            background:#f2f2f2;
        }

        .btn-print{
            background:#007bff;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:5px;
            cursor:pointer;
            font-size:14px;
        }

        .btn-print:hover{
            background:#0056b3;
        }

        @media print{
            .btn-print{
                display:none;
            }
        }
    </style>
</head>

<body>

</div>

<h2>LAPORAN PENJUALAN</h2>

<table>
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
    $no = 1;
    $grand_total = 0;

    $query = mysqli_query($koneksi,"
        SELECT pj.*,
               pl.nama_pelanggan
        FROM tabel_penjualan pj
        LEFT JOIN tabel_pelanggan pl
        ON pj.id_pelanggan = pl.id_pelanggan
        ORDER BY pj.tanggal_penjualan DESC
    ");

    while($data = mysqli_fetch_array($query)){

        $grand_total += $data['total_harga'];
    ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['kode_penjualan']; ?></td>
            <td><?= $data['nama_pelanggan']; ?></td>
            <td><?= date('d-m-Y', strtotime($data['tanggal_penjualan'])); ?></td>
            <td>Rp <?= number_format($data['total_harga'],0,',','.'); ?></td>
            <td><?= $data['status']; ?></td>
        </tr>

    <?php } ?>

        <tr>
            <th colspan="4">GRAND TOTAL</th>
            <th colspan="2">
                Rp <?= number_format($grand_total,0,',','.'); ?>
            </th>
        </tr>

    </tbody>
</table>

<br><br>

<table width="100%" border="0" style="border:none;">
    <tr>
        <td width="70%" style="border:none;"></td>
        <td align="center" style="border:none;">
            Pangkalpinang, <?= date('d-m-Y'); ?>
            <br><br><br><br>
            ______________________
            <br>
            Admin
        </td>
    </tr>
</table>

<script>
window.print();
</script>

</body>
</html>