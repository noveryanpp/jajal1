<?php

$username = "admin0";
$password = "tyzxc";
$host = "localhost";

$is_connect = mysqli_connect($host, $username, $password);

if($is_connect){
   mysqli_select_db($is_connect, "jajal_db");
}else{
    echo "raiso";
}
