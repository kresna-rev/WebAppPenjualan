<?php

$var01=$_POST['var01'];
$var02=$_POST['var02'];
$var03=$_POST['var03'];
$var04=$_POST['var04'];
$save=$_POST['save'];
$tabel="pengguna";
$kunci="id_pengguna='{$_GET['i']}'";

if($save)
{
  if($var01!="" and $var02!="" and $var03!="" and $var04!="")
  {
    $field = "
    username='$var01',
    nama='$var02',
    level='$var03',
    status='$var04'
    ";
    $tt_jihyo=Edit($tabel, $field, $kunci);
  }
  else
  {
    $tt_jihyo=Sweet("error","Maaf Data Gagal di Simpan","Periksa Kembali Inputan");
  }	
}

$cek_pengguna=AmbilData($tabel, $kunci);
switch ($cek_pengguna['level']) {
  case '1':
    $selected = "selected";
    break;
  case '2':
    $selected2 = "selected";
    break;
  case '3':
    $selected3 = "selected";
    break;

}
$cek_status=AmbilData($tabel, $kunci);
$cek_status['status'];
switch ($cek_status['status']) {
  case 'online':
    $online = "selected";
    break;
  case 'offline':
    $offline = "selected";
    break;

}


$template = "dashboard";
$title = "List Pengguna";
$active1 = "active";
$content = "

<h1 class='h3 mb-2 text-gray-800'><i class='fas fa-hamburger'></i> Edit Pengguna</h1>

<div class='container'>
  <!-- Outer Row -->
  <div class='row'>
    <div class='col-md-9 mx-auto'>
      <div class='card rounded o-hidden border-0 shadow-lg my-4'>
        <div class='card-body p-0'>
          <div class='row'>
            <div class='col-md'>
              <div class='p-5'>
                <div class='text-center'>
                  <h1 class='h4 text-gray-900 mb-4'>Masukan Data</h1>
                </div>
                <form class='user' action='' method='POST' autocomplete='off'>
                  <div class='form-group'>
                    <label for='uname' class='form-label'>Username</label>
                    <input type='text' class='form-control form-control-user' id='uname' aria-describedby='emailHelp' value='$cek_pengguna[username]' name='var01'>
                  </div>
                  <div class='form-group'>
                    <label for='uname' class='form-label'>Nama</label>
                    <input type='text' class='form-control form-control-user' id='uname' aria-describedby='emailHelp' value='$cek_pengguna[nama]' name='var02'>
                  </div>
                  <div class='form-group'>
                    <label for='lvl' class='form-label'>Level</label>
                    <select id='lvl' name='var03' class='form-select rounded-pill form-control' >
                    
                      <option value='' >Pilih Level...</option>
                      <option value='1' $selected>Pemilik</option>
                      <option value='2' $selected2>Gudang</option>
                      <option value='3' $selected3>Kasir</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label for='lvl' class='form-label'>Status</label>
                    <select id='lvl' name='var04' class='form-select rounded-pill form-control' >
                    
                      <option value='' >Pilih Level...</option>
                      <option value='online' $online>Aktif</option>
                      <option value='offline' $offline>Tidak Aktif</option>
                    </select>
                  </div>
                  <button type='submit' value='Update' name='save' class='btn btn-success'>
                    Update
                  </button>
                  <a href='?page=pemilik/list_pengguna' class='btn btn-danger'>Kembali</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

";