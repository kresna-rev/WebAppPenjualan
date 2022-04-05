<?php

$god_menu = "
  

<!-- Sidebar -->
<ul class='navbar-nav bg-gradient-primary sidebar sidebar-dark accordion' id='accordionSidebar'>

    <!-- Sidebar - Brand -->
    <a class='sidebar-brand d-flex align-items-center justify-content-center  href='#'>
        <div class='sidebar-brand-icon br'>
            <img src='assets/dashboard/img/Logo.png' alt='Logo' class=' rounded img-thumbnail bg-transparent mt-3 border-0'>
        </div>
    </a>
    <div class='sidebar-brand sidebar-brand-text my-0'>Minimart</div>

    <!-- Divider -->
    <hr class='sidebar-divider my-0'>
    <li class='nav-item $active'>
        <a class='nav-link' href='?page=home'>
            <i class='fas fa-house-user'></i>
            <span>Home</span>
        </a>
    </li>
    
    <hr class='sidebar-divider my-0'>
    <!-- Nav Item - Dashboard -->
    <li class='nav-item $active1'>
        <a class='nav-link' href='?page=pemilik/list_pengguna'>
            <i class='fas fa-fw fa-user'></i>
            <span>Pengguna</span></a>
    </li>
    <li class='nav-item $active2'>
        <a class='nav-link' href='?page=pemilik/lap_penjualan'>
            <i class='fas fa-fw fa-tag'></i>
            <span>Lap. Penjualan</span></a>
    </li>
    <li class='nav-item $active3'>
        <a class='nav-link' href='?page=pemilik/lap_pembelian'>
            <i class='fas fa-fw fa-tags'></i>
            <span>Lap. Pembelian</span></a>
    </li>


</ul>
<!-- End of Sidebar -->



";