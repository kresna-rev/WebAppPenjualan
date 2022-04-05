<?php
accessGudang();
$i=$_GET['i'];

//Peringatan Sebelum diHapus
$p=$_GET['p'];
switch($p)
{
    case "tanya":
        $tt_jihyo=SweetKonfirm("?page=gudang/supplier_hapus&i=$i");
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

$query_select="SELECT * FROM supplier";
$hasil=mysqli_query($connecting,$query_select);
foreach($hasil as $h)
{
  $nomor++;
  $data .= "
  <tbody>
    <tr>
      <td>$nomor</td>
      <td>{$h['nama']}</td>
      <td>{$h['alamat']}</td>
      <td>{$h['telp']}</td>
      <td>
        <a href='?page=gudang/supplier_edit&i={$h['id_supplier']}' class='btn btn-success btn-sm'>
          <i class='fas fa-edit'></i>
        </a>
        <a href='?page=$page&i={$h['id_supplier']}&p=tanya' class='btn btn-danger btn-sm'>
          <i class='fas fa-times'></i>
        </a>
      </td>
    </tr>
  </tbody>
  ";
}

$template = "dashboard";
$title = "List Supplier";
$active2 = "active";
$content = "

<!-- Page Heading -->
<div class='row'>
    <h1 class='h3 mb-2 text-gray-800 col-md-6'><i class='fas fa-tag'></i> List Supplier</h1>
    <div class='ml-auto'>
        <a href='?page=gudang/supplier_tambah' class='btn btn-primary mx-3'>
            <i class='fas fa-plus'></i>
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
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
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
