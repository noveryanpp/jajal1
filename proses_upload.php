<?php
session_start();
include 'config/connect.php';

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$minharga = $_POST['minharga'];
$maxharga = $_POST['maxharga'];
$foto_jasa = $_FILES["fotojasa"]["name"];
$tmpfoto_jasa = $_FILES["fotojasa"]["tmp_name"];
$mitra_id = $_SESSION['id'];

$uploadOk = 1;

$fileName = $_FILES["fotojasa"]["name"];

$query2 = mysqli_query($is_connect, "SELECT * FROM mitra WHERE id_client='$mitra_id'");
$data = mysqli_fetch_assoc($query2);

$id_mitra = $data['id'];
$intid = intval($id_mitra);

if ($_FILES["fotojasa"]["size"] > 1000000) {
    echo '<script language="javascript">';
    echo 'alert("Maaf, Ukuran File Terlalu Besar (Max = 1MB)");';
    echo 'window.location = "upload.php"';
    echo '</script>';
    $uploadOk = 0;
}
$allowedFormats = array("jpg", "png", "jpeg");
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
if (!in_array($fileExtension, $allowedFormats)) {
    echo '<script language="javascript">';
    echo 'alert("Maaf, hanya JPG, JPEG, PNG yang diperbolehkan");';
    echo 'window.location = "upload.php"';
    echo '</script>';
    $uploadOk = 0;
}

if($uploadOk==1){
$query9 = "INSERT INTO `service` (`judul`, `deskripsi`, `minharga`, `foto_jasa`, `id_mitra`, `tanggal_upload`, `maxharga`) 
            VALUES ('$judul', '$deskripsi', '$minharga', '$fileName', '$intid', now(), '$maxharga')";

$result = mysqli_query($is_connect, $query9);

$query10 = "SELECT id from service WHERE foto_jasa = '$fileName' and judul = '$judul' and id_mitra = '$intid'";
$result10 = mysqli_query($is_connect, $query10);
$dataid = mysqli_fetch_assoc($result10);
$serid = $dataid['id'];

$targetDir = "./assets/img/service/".$serid."/";

$targetFile = $targetDir . $fileName;

if(!is_dir($targetDir)){
    mkdir($targetDir, 0777);
}
if (isset($_POST["submit"])) {
    move_uploaded_file($_FILES["fotojasa"]["tmp_name"], $targetFile);
}
}

if (NULL != $result){
    echo '<script language="javascript">';
    echo 'alert("Berhasil Upload Jasa");';
    echo 'window.location = "dashboard.php"';
    echo '</script>';
}
?>