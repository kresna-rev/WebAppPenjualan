<?php

  $tabel="supplier";
  $kunci="id_supplier='{$_GET['i']}'";
  $hasil=Hapus($tabel, $kunci);
  
  if($hasil){
    header("location:?page=gudang/list_supplier&hasil=true");
  }else{
    header("location:?page=gudang/list_supplier&hasil=false");
  }
