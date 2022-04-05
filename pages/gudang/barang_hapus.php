<?php

  $tabel="barang";
  $kunci="id_barang='{$_GET['i']}'";
  $hasil=Hapus($tabel, $kunci);
  if($hasil){
    header("location:?page=gudang/list_barang&hasil=true");
  }else{
    header("location:?page=gudang/list_barang&hasil=false");
    }
  