<?php
accessPemilik();

$template   = "print";
$title      = "Lap. Penjualan";
$nama=Pengguna($_SESSION['id'])['nama'];
$tgl=$_GET['tgl'];
$tgl1=$_GET['tgl1'];

$q=mysqli_query($connecting, "SELECT * FROM penjualan_list WHERE DATE(waktu) BETWEEN '$tgl' AND '$tgl'");
foreach($q as $ar)
{
    $no++;
    $data.="
        <tr>
            <td class='text-center'>$no</td>
            <td class='text-center'>{$ar['kode']}</td>
            <td class='text-center'>{$ar['waktu']}</td>
            <td class='text-left'>{$ar['nama']}</td>
            <td class='text-right'>".rupiah($ar['total'])."</td>
        </tr>
    ";
    $total+=$ar['total'];
}


$content   = "

    <div class='row m-3'>
        <h1 class='h3 mb-2 text-gray-800 col-md-6'>Laporan Penjualan</h1>
        <h1 class='h3 text-gray-800 col-md-6 text-center'>Per ".date("d-m-Y")."</h1>
    </div>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th class='text-center' style='width:5%'>No</th>
                <th class='text-center' style='width:15%'>Kode</th>
                <th class='text-center' style='width:15%'>Waktu</th>
                <th class='text-center' style='width:30%'>Kasir</th>
                <th class='text-center' style='width:15%'>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            $data
            <tr>
                <th class='text-center'></th>
                <th class='text-center font-weight-bold' colspan='3'>TOTAL</th>
                <th class='text-right font-weight-bold'>".rupiah($total)."</th>
            </tr>
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