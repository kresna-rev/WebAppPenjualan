<?php

$var01=$_POST['var01'];
$var02=$_POST['var02'];
$var03=$_POST['var03'];
$save=$_POST['save'];

	if($save)
	{
		if($var01!="" and $var02!="" and $var03!="")
		{
		  $tabel = "supplier";
		  $field = "nama, alamat, telp";
		  $value = "'$var01', '$var02', '$var03'";
		  $tt_jihyo=Tambah($tabel, $field, $value);
		}
		else
		{
			$tt_jihyo=Sweet("error","Maaf Data Gagal di Simpan","Periksa Kembali Inputan");
		}	
	}

$template = "dashboard";
$title = "Supplier";
$content = "
<h1 class='h3 mb-2 text-gray-800'><i class='fas fa-tag'></i> Supplier</h1>

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
                  <div class='mb-3'>
                    <label for='nama' class='form-label'>Nama</label>
                    <input type='text' class='form-control' id='nama' name='var01' placeholder=''>
                  </div>
                  <div class='mb-3'>
                    <label for='alm' class='form-label'>Alamat</label>
                    <input type='text' class='form-control' id='alm' name='var02' placeholder=''>
                  </div>
                  <div class='mb-3'>
                    <label for='telp' class='form-label'>No. Telp</label>
                    <input type='text' class='form-control' id='telp' name='var03' placeholder=''>
                  </div>
                  

                  <button type='submit' value='Simpan' name='save' class='btn btn-primary '>
                    Simpan
                  </button>
                  
                  <a href='?page=gudang/list_supplier' class='btn btn-danger'>Kembali</a>
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