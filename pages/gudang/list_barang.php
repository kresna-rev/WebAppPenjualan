<?php
accessGudang();
$i=$_GET['i'];

//Peringatan Sebelum diHapus
$p=$_GET['p'];
switch($p)
{
    case "tanya":
        $tt_jihyo=SweetKonfirm("?page=gudang/barang_hapus&i=$i");
    break;
}

//TOWEWENG SETELAH DIHAPUS
$h=$_GET['hasil'];
switch($h)
{
    case "true":
        $tt_jihyo=Sweet("success","Data telah dihapus");
    break;
    case "false":
        $tt_jihyo=Sweet("info","Maaf Data tidak dapat dihapus");
    break;
}

$query_select="SELECT * FROM barang";
$hasil=mysqli_query($connecting,$query_select);
foreach($hasil as $h)
{
  $nomor++;
  $data .= "
    <tbody>
        <tr>
            <td>$nomor</td>
            <td class='barcode10'>{$h['barcode']}</td>
            <td>{$h['nama']}</td>
            <td>Rp. {$h['harga']}</td>
            <td>{$h['stok']}</td>
            <td>
                <a href='?page=gudang/barang_edit&i={$h['id_barang']}' class='btn btn-success btn-sm'>
                    <i class='fas fa-edit'></i>
                </a>
                <a href='?page=$page&i={$h['id_barang']}&p=tanya' class='btn btn-danger btn-sm'>
                    <i class='fas fa-times'></i>
                </a>
            </td>
        </tr>
    </tbody>
  ";
}

$template = "dashboard";
$title = "List Barang";
$active1 = "active";
$content = "

<!-- Page Heading -->
<div class='row'>
    <h1 class='h3 mb-2 text-gray-800 col-md-6'><i class='fas fa-box-open'></i> List Barang</h1>
    <div class='ml-auto'>
        <a href='?page=gudang/barang_tambah' class='btn btn-primary mx-3'>
            <i class='fas fa-plus'></i>
        </a>
        <a href='?page=gudang/lap_barang' class='btn btn-primary mx-3'>
            <i class='fas fa-file-alt'></i>
        </a>
    </div>
</div>
<!-- DataTales Example -->
<div class='card shadow mb-4 mt-3'>
  
  <div class='card-body'>
    <div class='row'>
        <div class='table-responsive'>
            <table class='table table-bordered' id='datatable' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Barcode</th>
                        <th>Nama</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                $data
                
            </table>
        </div>
    </div>
  </div>
</div>

";
