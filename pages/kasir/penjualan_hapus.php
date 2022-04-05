<?php

  $tabel="jual_barang";
  $kunci="id_penjualan='{$_GET['i']}'";
  $tgl=$_GET['tgl'];
  $hasil=Hapus($tabel, $kunci);
  if($hasil){
    header("location:?page=kasir/list_penjualan&tgl=$tgl&h=true");
  }else{
    header("location:?page=kasir/list_penjualan&tgl=$tgl&h=false");
    }
  