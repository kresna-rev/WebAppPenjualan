<?php

$i=$_GET['i'];
$hasil=Hapus("pengguna", "id_pengguna='$i'");
if($hasil){
    header("location:?page=pemilik/list_pengguna&h=true");
}else{
    header("location:?page=pemilik/list_pengguna&h=false");
}
  