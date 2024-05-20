<?php
include 'config/connect.php';

if(isset($_POST['register'])){
$username = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['nama'];
$no_telepon = $_POST['no_telepon'];
$alamat = $_POST['alamat'];
$foto_profil = $_POST['foto_profil'];
$email = $_POST['email'];
}

$query9 = "INSERT INTO `client` (`username`, `password`, `nama`, `no_telepon`, `alamat`, `member_sejak`, `foto_profil`, `email`, `id_mitra`) 
            VALUES ('$username', '$password', '$nama', '$no_telepon', '$alamat', now(), '$foto_profil', '$email', NULL);";

$result = mysqli_query($is_connect, $query9);

if (NULL != $result){
  header("Location: index.php");
} else {
  echo 'gagal';
}