<?php
session_start();
include 'config/connect.php';

$password = $_POST['password'];
$client_id = $_SESSION['id'];

$query9 = mysqli_query($is_connect, "SELECT * FROM mitra WHERE password='$password' and id_client='$client_id'");
$data = mysqli_fetch_assoc($query9);

if(NULL != $data){

  $_SESSION['id'] = $data['id'];
  $_SESSION['password'] = $password;

  header('Location: upload.php');
} else {
    echo '<script language="javascript">';
    echo 'alert("Login Failed! Check Username or Password");';
    echo 'window.location = "profile.php"';
    echo '</script>';
}
