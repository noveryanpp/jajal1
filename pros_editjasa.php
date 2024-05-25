<?php
session_start();
include 'config/connect.php';

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
}

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$minharga = $_POST['minharga'];
$maxharga = $_POST['maxharga'];
$mitra_id = $_SESSION['id'];
$idservice = $_POST['idservice'];

$uploadOk = 1;
$fileName = $_FILES["fotojasa"]["name"];

if (!empty($fileName)) {

    if ($_FILES["fotojasa"]["size"] > 1000000) {
        echo '<script language="javascript">';
        echo 'alert("Maaf, Ukuran File Terlalu Besar (Max = 1MB)");';
        echo 'window.location = "editjasa.php?idservice=' . $idservice . '"';
        echo '</script>';
        $uploadOk = 0;
    }

    $allowedFormats = array("jpg", "png", "jpeg");
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedFormats)) {
        echo '<script language="javascript">';
        echo 'alert("Maaf, hanya JPG, JPEG, PNG yang diperbolehkan");';
        echo 'window.location = "editjasa.php?idservice=' . $idservice . '"';
        echo '</script>';
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        $Squery = "SELECT * FROM service WHERE id = $idservice";
        $result3 = $is_connect->query($Squery);
        $service = $result3->fetch_assoc();
        $old_photo = $service['foto_jasa'];

        $old_photo_path = "./assets/img/service/" . $idservice . "/" . $old_photo;
        if (file_exists($old_photo_path)) {
            unlink($old_photo_path);
        }

        $query9 = "UPDATE service SET judul = '$judul', deskripsi = '$deskripsi', foto_jasa = '$fileName', minharga = $minharga, maxharga = $maxharga, tanggal_upload = NOW() WHERE id = $idservice";
        $result = $is_connect->query($query9);

        $targetDir = "./assets/img/service/" . $idservice . "/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $targetFile = $targetDir . $fileName;

        if (isset($_POST["submit"])) {
            move_uploaded_file($_FILES["fotojasa"]["tmp_name"], $targetFile);
        }
    }
} else {
    $query = "SELECT * FROM service WHERE id = $idservice";
    $result = $is_connect->query($query);
    $service = $result->fetch_assoc();
    $fileName = $service['foto_jasa'];

    $query9 = "UPDATE service SET judul = '$judul', deskripsi = '$deskripsi', minharga = $minharga, maxharga = $maxharga, tanggal_upload = NOW() WHERE id = $idservice";
    $result = $is_connect->query($query9);
}

if ($result) {
    echo '<script language="javascript">';
    echo 'alert("Berhasil Memperbarui Jasa");';
    echo 'window.location = "dashboard.php"';
    echo '</script>';
} else {
    echo '<script language="javascript">';
    echo 'alert("Gagal Memperbarui Jasa");';
    echo 'window.location = "editjasa.php?idservice=' . $idservice . '"';
    echo '</script>';
}
?>
