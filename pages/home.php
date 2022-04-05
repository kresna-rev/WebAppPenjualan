<?php

$nama=Pengguna($_SESSION['id'])['nama'];

$template = "dashboard";
$title = "Minimart - Home";
$active = "active";
$content = "

<h1 class='h3 mb-3 text-gray-800'>Selamat Datang, $nama!</h1>



";