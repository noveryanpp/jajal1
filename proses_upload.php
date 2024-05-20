<?php

session_start();
include 'config/connect.php';

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$foto_produk = $_POST['foto_produk'];
$minharga = $_POST['minharga'];
$maxharga = $_POST['maxharga'];
$mitra_id = $_SESSION['id'];


$query2 = mysqli_query($is_connect, "SELECT * FROM mitra WHERE id_client='$mitra_id'");
$data = mysqli_fetch_assoc($query2);

$id_mitra = $data['id'];
$intid = intval($id_mitra);

$query9 = "INSERT INTO `service` (`judul`, `deskripsi`, `foto_produk`, `minharga`, `id_mitra`, `tanggal_upload`, `maxharga`) 
            VALUES ('$judul', '$deskripsi', '$foto_produk', '$minharga', '$intid', now(), '$maxharga')";

$result = mysqli_query($is_connect, $query9);

if (NULL != $result){
  header("Location: dashboard.php");
} else {
  echo 'Database error: ' . $is_connect->error;
}