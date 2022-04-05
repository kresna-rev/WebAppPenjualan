<?php
accessPemilik();
$i=$_GET['i'];

//Peringatan Sebelum diHapus
$p=$_GET['p'];
switch($p)
{
    case "tanya":
        $tt_jihyo=SweetKonfirm("?page=pemilik/pengguna_hapus&i=$i");
    break;
}

//TOWEWENG SETELAH DIHAPUS
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



$query_select="SELECT * FROM pengguna";
$hasil=mysqli_query($connecting,$query_select);
foreach($hasil as $h)
{
    $nomor++;
    $data .= "
        <tbody>
            <tr>
                <td>$nomor</td>
                <td>{$h['username']}</td>
                <td>{$h['nama']}</td>
                <td class='text-center'>".Status($h['status'])."</td>
                <td class='text-center'>".Level($h['level'])."</td>
                <td>
                    <a href='?page=pemilik/pengguna_edit&i={$h['id_pengguna']}' class='btn btn-success btn-sm'>
                        <i class='fas fa-edit'></i>
                    </a>
                    <a href='?page=pemilik/pengguna_resetpas&i={$h['id_pengguna']}' class='btn btn-warning btn-sm'>
                        <i class='fas fa-lock'></i>
                    </a>
                    <a href='?page=$page&i={$h['id_pengguna']}&p=tanya' class='btn btn-danger btn-sm'>
                        <i class='fas fa-times'></i>
                    </a>
                </td>
            </tr>
        </tbody>
  ";
}

$template = "dashboard";
$title = "List Pengguna";
$active1 = "active";
$content = "

<!-- Page Heading -->
<div class='row'>
    <h1 class='h3 mb-2 text-gray-800 col-md-6'><i class='fas fa-hamburger'></i> List Pengguna</h1>
    <div class='ml-auto'>
        <a href='?page=pemilik/pengguna_tambah' class='btn btn-primary mx-3'>tambah 
            <i class='fas fa-plus'></i>
        </a>
    </div>
</div>
<!-- DataTales Example -->
<div class='card shadow mb-4 mt-3'>
  <div class='card-header py-2'>
    <div class='row'>
      <div class='col-6 mt-2'>
        <h6 class='font-weight-bold text-primary'>daftar pengguna</h6>
      </div>
    </div>
  </div>
  <div class='card-body'>
    <div class='row'>
        <div class='table-responsive'>
            <table class='table table-bordered' id='datatable' width='100%' cellspacing='0'>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Level</th>
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
