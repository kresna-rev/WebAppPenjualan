<?php

$template   = "dashboard";
$title      = "Penjualan";
$active3="active";
$id=$_GET['id']; //kode pemblian
$id1=$_GET['id1'];//kode barang beli
$aksi=$_GET['aksi'];

$a1=$_POST['a1'];
$a2=$_POST['a2'];
$a3=$_POST['a3'];
$a4=$_POST['a4'];
$a5=$_POST['a5'];
$tombol=$_POST['tombol'];
$tabel="penjualan";


switch($tombol)
{
    case "Update":
        $qbarang = AmbilData("barang", "barcode=$a2");
        $qbarang['harga'];
        $stok=$qbarang['stok'];
        if($stok < $a3){
            $tt_jihyo=Sweet("info","Stok Tidak Cukup","Periksa Kembali Stok Barang");
        }else{
            if($a3==""){
                $a3=1;
            }
            
            TambahTrans("jual_barang",
            "id_barang, id_penjualan, banyak_jual, harga_jual",
            "'{$qbarang['id_barang']}','$id','$a3','{$qbarang['harga']}'");
            header("location:?page=$page&id=$id");
        }
    break;
    
}

switch($aksi)
{
    case "hapus":
        Hapus("jual_barang","id_jual_barang='$id1'");
    break;
}


if($id!="")
{
    $kunci="id_penjualan='$id'";
    $DataBeli=AmbilData($tabel,$kunci);
    $a1=$DataBeli['kode'];
    $a2=$DataBeli['id_barang'];
    $total=0;

    $q=AmbilDataTrans(", SUM(banyak_jual) AS Qty, SUM(banyak_jual) * harga_jual AS jumlah1","struk_jual","where id_penjualan='$id' GROUP BY id_barang");
    foreach($q as $qbaru)
    {
        $number++;
        $data.="
            <tr>
                <td class='text-center'>$number</td>
                <td class='text-left'>{$qbaru['barcode']}</td>
                <td class='text-left'>{$qbaru['nama']}</td>
                <td class='text-center'>{$qbaru['Qty']}</td>
                <td class='text-right'>".rupiah($qbaru['harga_jual'])."</td>
                
                <td class='text-right'>".rupiah($qbaru['jumlah1'])."</td>
                <td class='text-center'>
                  <a href='?page=$page&id=$id&id1={$qbaru['id_jual_barang']}&aksi=hapus' class='btn btn-danger'>
                    <i class='fa fa-times'></i>
                  </a>
                </td>
            </tr>
        ";
        $total+=$qbaru['jumlah1'];
    }

    $hasil="
    <div class='card rounded o-hidden border-0 shadow-lg my-4'>
        <div class='card-body'>
            <div class='row text-center'>
                <div class='table-responsive'>
                    <table class='table table-bordered mt-3'>
                        <thead>
                            <tr>
                                <th class='text-center' style='width:5%'>No</th>
                                <th class='text-center' style='width:15%'>Kode</th>
                                <th class='text-center'>Nama Barang</th>
                                <th class='text-center' style='width:10%'>Qty</th>
                                <th class='text-center' style='width:15%'>Harga</th>
                                <th class='text-center' style='width:15%'>Jumlah</th>
                                <th class='text-center' style='width:10%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            $data
                            <tr>
                                <th class='text-center'></th>
                                <th class='text-center font-weight-bold' colspan='4'>TOTAL</th>
                                <th class='text-right font-weight-bold'>".rupiah($total)."</th>
                                <th class='text-center'></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    ";
}


$qbarang=AmbilDataAll("barang","where stok>0");
foreach ($qbarang as $arbarang) 
{
    $listbarang.="
        <option value='{$arbarang['id_barang']}'> {$arbarang['barcode']} | {$arbarang['nama']} </option>
    ";
}



if($id!="")
{
        $TTambahan="    
            <input type='submit' name='tombol' value='Update' class='btn btn-primary btn-md'>
            
        ";

        $FTambahan="
            <div class='form-group row'>
                <label class='col-sm-2 col-form-label'>Jumlah</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' name='a3'>
                </div>
            </div>
        ";

    
    
        
}

$content   = "
    <h1 class='h3 mb-2 text-gray-800'><i class='fas fa-shopping-cart'></i> Penjualan</h1>
    <div class='row p-2'>
    <div class='col-md-12'>
        <div class='float-right'>
        <a href='?page=kasir/list_penjualan' class='btn btn-info'><i class='fas fa-arrow-left'></i></a>
        </div>
    </div>
    </div>
    <form method='post' autocomplete='off'>
        <div class='form-group row'>
            <label class='col-sm-2 col-form-label'>Kode</label>
            <div class='col-sm-4'>
                <input type='text' class='form-control' name='a1' value='$a1' readonly>
            </div>
        </div>
        $FTambahan
        <div class='form-group row'>
            <label class='col-sm-2 col-form-label'>Barang</label>
            <div class='col-sm-6'>
                <input type='text' class='form-control' name='a2' value='$a2' $disabled autofocus>
            </div>
        </div>
        $TTambahan
    </form>
    
    $hasil
";
