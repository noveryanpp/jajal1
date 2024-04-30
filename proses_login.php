<?php
session_start();
include 'config/connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query9 = mysqli_query($is_connect, "SELECT * FROM client WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query9);

if(NULL != $data){

  $_SESSION['id'] = $data['id'];
  $_SESSION['username'] = $username;
  $_SESSION['password'] = $password;

  header('Location: index.php');
} else {
    echo '<script language="javascript">';
    echo 'alert("Login Failed! Check Username or Password");';
    echo 'window.location = "index.php"';
    echo '</script>';
}
