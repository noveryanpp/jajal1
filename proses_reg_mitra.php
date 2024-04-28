<?php

include 'config/connect.php';


$username = $_POST['username'];
$password = $_POST['password'];
$nama_sekolah = $_POST['nama_sekolah'];
$no_telepon = $_POST['no_telepon'];
$foto_profil = $_POST['foto_profil'];
$nisnisn = $_POST['nis/nisn'];
$sertifikasi = $_POST['sertifikasi'];

$query8 = mysqli_query($is_connect, "SELECT id FROM client WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query8);

$id_client = $data['id'];

$query9 = "INSERT INTO `mitra` (`id`, `password`, `nama_sekolah`, `no_telepon`, `foto_profil`, `nis/nisn`, `sertifikasi`, `id_client`) 
            VALUES (NULL, '$password', '$nama_sekolah', '$no_telepon', '$foto_profil', '$nisnisn', NULL, '$id_client');";

$result = mysqli_query($is_connect, $query9);

if (NULL != $result){
  header("Location: index.php");
} else {
  echo 'gagal';
}