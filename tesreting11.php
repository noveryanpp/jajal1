<?php
require_once("config/connect.php");

session_start(); 

if (!isset($_SESSION['id'])) {
    echo '<script language="javascript">';
    echo 'alert("Silahkan Login Terlebih Dahulu!");';
    echo 'window.location = "index.php"';
    echo '</script>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $idservice = $_GET['idservice'];
    $query1 = "SELECT service.*, client.nama as namapenjual 
               FROM service 
               INNER JOIN client ON service.id_mitra = client.id_mitra WHERE service.id= '$idservice'";
    $result1 = mysqli_query($is_connect, $query1);

    $fetch_data = mysqli_fetch_all($result1, MYSQLI_BOTH);
    foreach($fetch_data as $service)
    
    $idclient = $_SESSION['id'];
    $id_client = intval($idclient);
    $id_service = intval($service['id']);
    $intid = intval($id_service);
    $rating = $_POST["rating"];
    $komentar = $_POST["komentar"];
    $tanggal = date("Y-m-d H:i:s");

    $Cquery = "SELECT * FROM `review` WHERE id_client = '$id_client' AND id_service = '$intid'";

    $result2 = mysqli_query($is_connect, $Cquery);

    if($result2->num_rows > 0){
        $Uquery = "UPDATE review SET tanggal ='$tanggal', komentar='$komentar', rating='$rating' where id_client ='$id_client' and id_service ='$intid'";
        $result3 = mysqli_query($is_connect, $Uquery);

        if($result3 != NULL){
            header("Location: service.php?idservice=".$idservice);
        }else{
            echo '<script language="javascript">';
            echo 'alert("Gagal Mereview");';
            echo 'window.location = "service.php?idservice="'.$idservice;
            echo '</script>';
        }
    } else{
        $sql = "INSERT INTO review (id_client, id_service, tanggal, komentar, rating) 
        VALUES ('$id_client', '$intid', '$tanggal', '$komentar', '$rating') ";

        if (mysqli_query($is_connect, $sql))
        {
            header("Location: service.php?idservice=".$idservice);
        }
        else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($is_connect);
        }
    }
}
?>
