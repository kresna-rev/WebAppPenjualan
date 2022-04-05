<?php

$template   = "dashboard";
$title      = "Pembelian";
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
$tabel="pembelian";


switch($tombol)
{
    case "Update":

        TambahTrans("beli_barang",
        "id_barang, id_pembelian, banyak_beli, harga_beli",
        "'$a3','$id','$a5','$a4'");

        header("location:?page=$page&id=$id");
    break;
    
}

switch($aksi)
{
    case "hapus":
        Hapus("beli_barang","id_beli_barang='$id1'");
    break;
}


if($id!="")
{
    $kunci="id_pembelian='$id'";
    $DataBeli=AmbilData($tabel,$kunci);
    $a1=$DataBeli['kode'];
    $a2=$DataBeli['id_supplier'];
    $total=0;

    $q=AmbilDataAll("barang_beli_list","where id_pembelian='$id'");
    foreach($q as $qbaru)
    {
        $number++;
        $data.="
            <tr>
                <td class='text-center'>$number</td>
                <td class='text-left'>{$qbaru['barcode']}</td>
                <td class='text-left'>{$qbaru['nama']}</td>
                <td class='text-center'>{$qbaru['banyak_beli']}</td>
                <td class='text-right'>".rupiah($qbaru['harga_beli'])."</td>
                
                <td class='text-right'>".rupiah($qbaru['jumlah'])."</td>
                <td class='text-center'>
                  <a href='?page=$page&id=$id&id1={$qbaru['id_beli_barang']}&aksi=hapus' class='btn btn-danger'>
                    <i class='fa fa-times'></i>
                  </a>
                </td>
            </tr>
        ";
        $total+=$qbaru['jumlah'];
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


$qbarang=AmbilDataAll("barang","");
foreach ($qbarang as $arbarang) 
{
    $listbarang.="
        <option value='{$arbarang['id_barang']}' > {$arbarang['barcode']} {$arbarang['nama']} </option>
    ";
}

//Supplier
$qsup=AmbilDataAll("supplier","");
foreach ($qsup as $arsup) 
{
    if($a2==$arsup['id_supplier'])
    {
        $listsup.="
            <option value='{$arsup['id_supplier']}' selected> {$arsup['nama']} </option>
        ";
    }
    else
    {
        $listsup.="
            <option value='{$arsup['id_supplier']}'> {$arsup['nama']} </option>
        ";
    }
    
}


if($id!="")
{
        $TTambahan="    
            <input type='submit' name='tombol' value='Update' class='btn btn-primary btn-md'>
        ";

        $FTambahan="
            <div class='form-group row'>
                <label class='col-sm-2 col-form-label'>Barang</label>
                <div class='col-sm-6'>
                    <select class='form-control select2' name='a3'>
                        <option value=''> - - Pilih - - </option>
                        $listbarang
                    </select>
                </div>
            </div>
            <div class='form-group row'>
                <label class='col-sm-2 col-form-label'>Harga</label>
                <div class='input-group col-sm-5'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text' id='basic-addon1'>Rp</span>
                    </div>
                    <input type='text' class='form-control' name='a4'>

                </div>
            </div>
            <div class='form-group row'>
                <label class='col-sm-2 col-form-label'>Jumlah</label>
                <div class='col-sm-2'>
                    <input type='text' class='form-control' name='a5'>
                </div>
            </div>
        ";

    
    $disabled="disabled";
        
}
else
{
    $TTambahan="
        <input type='submit' name='tombol' value='Baru' class='btn btn-success btn-md'>
    ";
}

$content   = "
<h1 class='h3 mb-2 text-gray-800'><i class='fas fa-tags'></i> Pembelian</h1>
<div class='row p-2'>
  <div class='col-md-12'>
    <div class='float-right'>
      <a href='?page=gudang/list_pembelian' class='btn btn-info'><i class='fas fa-arrow-left'></i></a>
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
        <div class='form-group row'>
            <label class='col-sm-2 col-form-label'>Supplier</label>
            <div class='col-sm-6'>
                <select class='form-control select2' name='a2' value='$a2' $disabled>
                    <option value=''> - - Pilih - - </option>
                    $listsup
                </select>
            </div>
        </div>
        $FTambahan
        $TTambahan
    </form>
    $hasil
";
