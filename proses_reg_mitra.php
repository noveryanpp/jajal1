<?php
session_start();
include('config/connect.php');

if(isset($_POST['registermitra'])){
$nama_sekolah = $_POST['nama_sekolah'];
$no_telepon = $_POST['no_telepon'];
$foto_profil = $_POST['foto_profil'];
$nisnisn = $_POST['nis/nisn'];
$sertifikasi = $_POST['sertifikasi'];
$password = $_POST['password'];
}
if(isset($_SESSION['id'])){
  $id_client = $_SESSION['id'];
  $intid = intval($id_client);
  $query1 =mysqli_query($is_connect,"SELECT * FROM client WHERE id='$id_client';");
  $data = mysqli_fetch_assoc($query1);
  if($password == $data['password']){
    $query9 = "INSERT INTO `mitra` (`nama_sekolah`, `no_telepon`, `foto_profil`, `nis/nisn`, `sertifikasi`, `id_client`) VALUES ('$nama_sekolah', '$no_telepon', '$foto_profil', '$nisnisn', NULL, '$intid');";
    $result = mysqli_query($is_connect, $query9);

    $query10 = "SELECT id from mitra WHERE id_client='$intid'";
    $res2 = mysqli_query($is_connect, $query10);
    $dataid = mysqli_fetch_assoc($res2);
    
    $id = intval($dataid['id']);

    $query11 = "UPDATE client SET id_mitra = '$id' WHERE id = '$intid'";
    $res3 = mysqli_query($is_connect, $query11);
    }else{
      echo '<script language="javascript">';
      echo 'alert("Password Salah!!");';
      echo 'window.location = "registermitra.php"';
      echo '</script>';
  }
};

if (NULL != $result){
  header("Location: dashboard.php");
} else {
  echo '<script language="javascript">';
  echo 'alert("Gagal Mendaftar Mitra, Silahkan Coba Lagi!");';
  echo 'window.location = "registermitra.php"';
  echo '</script>';
}
?>