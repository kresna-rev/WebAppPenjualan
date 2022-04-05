<?php
accessGudang();

$template   = "dashboard";
$title      = "Lap. Barang";
$active1="active";
$a1=$_GET['a1'];
$a2=$_GET['a2'];

$q=mysqli_query($connecting, "SELECT * FROM barang");
foreach($q as $ar)
{
    $no++;
    $data.="
        <tr>
            <td class='text-center'>$no</td>
            <td class='text-center'>{$ar['barcode']}</td>
            <td class='text-center'>{$ar['nama']}</td>
            <td class='text-left'>{$ar['stok']}</td>
        </tr>
    ";
}

$content   = "

    <div class='row'>
        <h1 class='h3 mb-2 text-gray-800 col-md-6'><i class='fas fa-box-open'></i> Lap. Barang</h1>
        <div class='ml-auto'>
            <a href='?page=gudang/list_barang' class='btn btn-primary mx-3'>
                <i class='fas fa-arrow-left'></i>
            </a>
            <a href='?page=gudang/print_lap_barang' target='_blank' class='btn btn-info mx-3'>
                <i class='fas fa-print'></i>
            </a>
        </div>
    </div>
    
    <div class='card rounded o-hidden border-0 shadow-lg my-4'>
        <div class='card-body'>
            <div class='row text-center'>
                <div class='table-responsive'>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th class='text-center' style='width:5%'>No</th>
                                <th class='text-center' style='width:15%'>Kode</th>
                                <th class='text-center' style='width:30%'>Nama  Barang</th>
                                <th class='text-center' style='width:15%'>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            $data
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
";
