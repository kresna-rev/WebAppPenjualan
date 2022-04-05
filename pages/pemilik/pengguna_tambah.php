<?php

$var01=$_POST['var01'];
$var02=$_POST['var02'];
$var03=$_POST['var03'];
$save=$_POST['save'];

	if($save)
	{
		
		if($var01!="" and $var02!="" and $var03!="")
		{
		  $tabel = "pengguna";
		  $field = "username, nama, level";
		  $value = "'$var01', '$var02', '$var03'";
		  $tt_jihyo=Tambah($tabel, $field, $value);
		}
		else
		{
			$tt_jihyo=Sweet("error","Maaf Data Gagal di Simpan","Periksa Kembali Inputan");
		}	
	}

$template = "dashboard";
$title = "List Pengguna";
$active1 = "active";
$content = "

<h1 class='h3 mb-2 text-gray-800'><i class='fas fa-hamburger'></i> Tambah Pengguna</h1>

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
                    <label for='name' class='form-label'>Username</label>
                    <input type='text' class='form-control form-control-user' id='name' aria-describedby='emailHelp' placeholder='Username' name='var01'>
                  </div>
                  <div class='form-group'>
                    <label for='uname' class='form-label'>Nama</label>
                    <input type='text' class='form-control form-control-user' id='uname' aria-describedby='emailHelp' placeholder='Nama' name='var02'>
                  </div>
                  
                  <div class='form-group'>
                    <label for='lvl' class='form-label'>Level</label>
                    <select id='lvl' name='var03' class='form-select rounded-pill form-control'>
                      <option selected>Pilih Level...</option>
                      <option value='1'>Pemilik</option>
                      <option value='2'>Bagian Gudang</option>
                      <option value='3'>Kasir</option>
                    </select>
                  </div>
                  <button type='submit' value='Simpan' name='save' class='btn btn-success'>
                    Simpan
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