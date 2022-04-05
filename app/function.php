<?php

//Fungsi untuk login
function Login($username="",$password="")
  {
    global $connecting;
    $status="status='online'";
       
    $Query=mysqli_query($connecting,"select * from pengguna where md5(username)=md5('$username') and password=md5('$password') and $status");

    if(mysqli_num_rows($Query))
    {
      $data=mysqli_fetch_assoc($Query);

      $_SESSION['id']=$data['id_pengguna'];
      $_SESSION['jenis_log']=$data['level'];

      header("location:index.php");
    }
    // elseif ($status!="") {
    //   return Sweet("info","Maaf Akun Anda Telah di Non-Aktifkan","Periksa kembali inputan");
    // }
    else
    {
      return Sweet("info","Maaf Login gagal","Periksa kembali inputan");
    }

    }

//fungsi untuk data pengguna
function Pengguna($kunci)
  {
    global $connecting;

    $Query=mysqli_query($connecting,"SELECT * FROM pengguna WHERE id_pengguna='$kunci'");
    return mysqli_fetch_assoc($Query);
       
  }


//funsi untuk menampilkan level pengguna
function Level($data)
  {
    switch($data)
    {
      case "1":return "<div class='bg-danger text-white btn btn-sm rounded-pill'>Pemilik</div>";
      break;
      case "2":return "<div class='bg-primary text-white btn btn-sm rounded-pill'>Gudang</div>";
      break;
      case "3":return "<div class='bg-info text-white btn btn-sm rounded-pill'>Kasir</div>";
      break;
    }
  }

//fungsi untuk menampilkan status
function Status($status){
  switch($status){
    case "offline": return "<span class='btn btn-secondary btn-sm rounded-pill'>Tidak Aktif</span>";
    break;
    case "online": return "<span class='btn btn-success btn-sm rounded-pill'>Aktif</span>";
    break;
  }
}
   
//fungsi untuk sweetalert2 sederhana
function Sweet($icon="",$peringatan="",$keterangan="")
  {
    return "
      <script>
        Swal.fire({
          position: 'center',
          icon: '".$icon."',
          title: '".$peringatan."',
          text: '".$keterangan."',
          showConfirmButton: false,
          timer: 1500
        })
      </script>
    ";
  }

//ResetPengguna
function ResetPengguna($pass,$kunci)
  {
    global $connecting;

    $q="UPDATE pengguna SET password=md5('$pass') WHERE id_pengguna='$kunci'";
    $hasil=mysqli_query($connecting,$q);
    if($hasil)
    {
      $keterangan=Sweet("success","Data berhasil disimpan","");
    }
    else
    {
      $keterangan=Sweet("error","Data gagal disimpan","");
    }

    return $keterangan;
  }

//konfirm
function SweetKonfirm($linkdirect)
  {
    return "
      <script>
        Swal.fire({
          title: 'Yakin data akan dihapus?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yakin'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '".$linkdirect."';
            }
          })
      </script>
    ";
  }

//Akses
function accessPemilik()
{
  if ($_SESSION['jenis_log']!="1") {
    header("location:index.php?page=home");
  }
}
function accessGudang()
{
  if ($_SESSION['jenis_log']!="2") {
    header("location:index.php?page=home");
  }
}
function accessKasir()
{
  if ($_SESSION['jenis_log']!="3") {
    header("location:index.php?page=home");
  }
}

//QUERY Tambah
function Tambah($tabel,$field,$value)
  {
    global $connecting;
    
    $q="INSERT INTO $tabel ($field) VALUES ($value)";

    $hasil=mysqli_query($connecting,$q);
    if($hasil)
    {
      $keterangan=Sweet("success","Data berhasil disimpan","");
    }
    else
    {
      $keterangan=Sweet("error","Data gagal disimpan","");
    }

    return $keterangan;
  }

//Query Edit/UPDATE
function Edit($tabel,$field,$kunci)
  {
    global $connecting;

    $q="UPDATE $tabel SET $field WHERE $kunci";
    $hasil=mysqli_query($connecting,$q);
    if($hasil)
    {
      $keterangan=Sweet("success","Data berhasil disimpan","");
    }
    else
    {
      $keterangan=Sweet("error","Data gagal disimpan","");
    }

    return $keterangan;
  }

function AmbilData($tabel,$kunci)
  {
    global $connecting;
    $query="select * from $tabel where $kunci";
    $query=mysqli_query($connecting,$query);
    return mysqli_fetch_assoc($query);
    }

function AmbilDataAll($tabel,$lain)
  {
    global $connecting;
    $query="select * from $tabel $lain";
    return mysqli_query($connecting,$query);
  }

function AmbilDataTrans($field,$tabel,$lain)
  {
    global $connecting;
    $query="select * $field from $tabel $lain";
    return mysqli_query($connecting,$query);
  }

function Hapus($tabel,$kunci)
  {
    global $connecting;
    $q="DELETE FROM $tabel where $kunci";
    return mysqli_query($connecting,$q);
  }

function TambahTrans($tabel,$field,$value)
  {
    global $connecting;

    $q="INSERT INTO $tabel ($field) VALUES ($value)";
    return mysqli_query($connecting,$q);
  }
    
function rupiah($angka)
  {
    return number_format($angka,0,',','.');
  }