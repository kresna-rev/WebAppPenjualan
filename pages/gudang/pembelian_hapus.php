<?php

  $tabel="beli_barang";
  $kunci="id_pembelian='{$_GET['i']}'";
  $tgl=$_GET['tgl'];
  $hasil=Hapus($tabel, $kunci);
  if($hasil){
    header("location:?page=gudang/list_pembelian&tgl=$tgl&h=true");
  }else{
    header("location:?page=gudang/list_pembelian&tgl=$tgl&h=false");
    }
  