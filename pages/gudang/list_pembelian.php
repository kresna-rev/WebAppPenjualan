<?php
accessGudang();

$template   = "dashboard";
$title      = "Pembelian";
$active3="active";

$i=$_GET['i'];
$tgl=$_GET['tgl'];

$tombol=$_POST['tombol'];
$a1=$_POST['a1'];
$tabel="pembelian_list";


if($tombol)
{
    header("location:?page=$page&tgl=$a1");
}

if($tgl!="")
{
    $lain="WHERE DATE(waktu)='$tgl'";
    $q=AmbilDataAll($tabel,$lain);
    $total=0;
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
                <td class='text-center'>
                        
                    <a href='?page=gudang/pembelian_edit&id={$ar['id_pembelian']}' class='btn btn-success btn-sm'>
                        <i class='fas fa-edit'></i>
                    </a>
                    <a href='?page=$page&i={$ar['id_pembelian']}&p=tanya&tgl=$tgl' class='btn btn-danger btn-sm'>
                        <i class='fas fa-times'></i>
                    </a>
                    
                </td>
            </tr>
        ";
        $total+=$ar['total'];
    }

    $hasil="
    <div class='card rounded o-hidden border-0 shadow-lg my-4'>
        <div class='card-body'>
            <div class='row text-center'>
                <div class='table-responsive'>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th class='text-center' style='width:5%'>No</th>
                                <th class='text-center' style='width:15%'>Kode</th>
                                <th class='text-center' style='width:15%'>Waktu</th>
                                <th class='text-center' style='width:30%'>Supplier</th>
                                <th class='text-center' style='width:15%'>Jumlah</th>
                                <th class='text-center' style='width:10%'>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            $data
                            <tr>
                                <th class='text-center'></th>
                                <th class='text-center font-weight-bold' colspan='3'>TOTAL</th>
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

$content   = "

    <div class='row'>
        <h1 class='h3 mb-2 text-gray-800 col-md-6'><i class='fas fa-tags'></i> List Pembelian</h1>
        <div class='ml-auto'>
            <a href='?page=gudang/pembelian_tambah' class='btn btn-primary mx-3'>
                <i class='fas fa-plus'></i>
            </a>
        </div>
    </div>
    <form method='post' autocomplete='off' action='?page=$page'>
        <div class='form-group row'>
            <label class='col-sm-1 col-form-label'>Tanggal</label>
            <div class='col-sm-3'>
                <input type='text' class='form-control' name='a1' value='$a1' placeholder='yyyy-mm-dd'>
            </div>
            <div class='col-sm-4'>
                <input type='submit' name='tombol' value='Lihat' class='btn btn-primary btn-md'>
            </div>
        </div>
    </form>
    
    $hasil
    
    
";

$p=$_GET['p'];
switch($p)
{
    case "tanya":
        $tt_jihyo=SweetKonfirm("?page=gudang/pembelian_hapus&i=$i&tgl=$tgl");
    break;
}

$h=$_GET['h'];
switch($h)
{
    case "true":
        $tt_jihyo=Sweet("success","Data telah dihapus");
    break;
    case "false":
        $tt_jihyo=Sweet("info","Maaf Data tidak dapat dihapus");
    break;
}
