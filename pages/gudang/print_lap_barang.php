<?php
accessGudang();

$template   = "print";
$title      = "Lap. Barang";
$nama=Pengguna($_SESSION['id'])['nama'];

$q=mysqli_query($connecting, "SELECT * FROM barang");
foreach($q as $ar)
{
    $no++;
    $data.="
        <tr>
            <td class='text-center'>$no</td>
            <td class='text-center'>{$ar['barcode']}</td>
            <td class='text-center'>{$ar['nama']}</td>
            <td class='text-center'>".rupiah($ar['harga'])."</td>
            <td class='text-left'>{$ar['stok']}</td>
        </tr>
    ";
}


$content   = "

    <div class='row m-3'>
        <h1 class='h3 text-gray-800 col-md-6 text-center'>Laporan Stok Barang</h1>
        <h1 class='h3 text-gray-800 col-md-6 text-center'>Per ".date("d-m-Y")."</h1>
    </div>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th class='text-center' style='width:5%'>No</th>
                <th class='text-center' style='width:15%'>Kode</th>
                <th class='text-center' style='width:30%'>Nama  Barang</th>
                <th class='text-center' style='width:30%'>Harga</th>
                <th class='text-center' style='width:15%'>Stok</th>
            </tr>
        </thead>
        <tbody>

            $data

        </tbody>
    </table>
    <div style='margin-top: 3em; float: right;'>
        <div>
            <p>Subang, ".date("d-m-Y")."</p>
            <p>Bagian Gudang</p>
            <p style='margin-top: 7em'>
                $nama
            </p>
        </div>
    </div>
";
