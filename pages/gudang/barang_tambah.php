<?php

$var01=$_POST['var01'];
$var02=$_POST['var02'];
$var03=$_POST['var03'];
$var04=$_POST['var04'];

$save=$_POST['save'];

	if($save)
	{
		if($var01!="" and $var02!="" and $var03!="")
		{
		  $tabel="barang";
		  $field="barcode, nama, harga";
		  $value="'$var01', '$var02', '$var03'";
		  
		  $tt_jihyo=Tambah($tabel, $field, $value);
		}
		else
		{
		  $tt_jihyo=Sweet("error","Maaf Data Gagal di Simpan","Periksa Kembali Inputan");
		}	
	}

$template = "dashboard";
$title = "Barang";
$content = "

<h1 class='h3 mb-2 text-gray-800'><i class='fas fa-box-open'></i> Barang</h1>

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
                    <label for='nm' class='form-label'>Nama Barang</label>
                    <input type='text' class='form-control form-control-user' id='nm' aria-describedby='emailHelp' placeholder='Nama Barang' name='var02'>
                  </div>
                  <div class='form-group'>
                    <label for='hr' class='form-label'>Harga</label>
                    <input type='text' class='form-control form-control-user' id='hr' aria-describedby='emailHelp' placeholder='9.000' name='var03'>
                  </div>
                  <div class='form-group'>
                    <label for='br' class='form-label'>Barcode</label>
                    <input type='text' class='form-control form-control-user' id='br' aria-describedby='emailHelp' placeholder='Barcode' name='var01'>
                  </div>
                  
                  <button type='submit' value='Tambah' name='save' class='btn btn-success'>
                    Tambah
                  </button>
                  <a href='?page=gudang/list_barang' class='btn btn-danger'>Kembali</a>
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