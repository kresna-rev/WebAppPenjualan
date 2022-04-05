<?php

$query_pengguna = mysqli_query($connecting, "SELECT * FROM pengguna WHERE id_pengguna='{$_GET['i']}'");
$cek_pengguna=mysqli_fetch_assoc($query_pengguna);
$id=$_GET['i'];
$username=$cek_pengguna['username'];
$nama=$cek_pengguna['nama'];
$pass=$cek_pengguna['password'];
$btn=$_POST['btn'];
if($btn){
  $random=rand(1000,9999);
  ResetPengguna($random,$id);
}

$template = "dashboard";
$title = "List Pengguna";
$active1 = "active";
$content = "

<h1 class='h3 mb-2 text-gray-800'><i class='fas fa-hamburger'></i> Reset Password Pengguna</h1>

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
                    <input type='text' class='form-control form-control-user' id='uname' aria-describedby='emailHelp' value='$username' name='username'>
                  </div>
                  <div class='form-group'>
                    <label for='uname' class='form-label'>Nama</label>
                    <input type='text' class='form-control form-control-user' id='uname' aria-describedby='emailHelp' value='$nama' name='nama'>
                  </div>
                  <div class='form-group'>
                    <label for='pw' class='form-label'>Password Baru</label>
                    <input type='text' class='form-control form-control-user' id='pw' aria-describedby='emailHelp' value='$random' name='password' readonly>
                  </div>
                  
                  <input type='submit' value='Reset' name='btn' class='btn btn-success'>
                   
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