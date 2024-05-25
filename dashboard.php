<?php

session_start(); // ketika mulai session harus ada sintak ini dulu

require_once("config/connect.php");
if(isset($_SESSION['id'])){
    $idclient = $_SESSION['id'];
    $query = mysqli_query($is_connect, "SELECT * FROM client WHERE id = $idclient ");

    if(mysqli_num_rows($query) == 1){
        $row = mysqli_fetch_assoc($query);
        $id_mitra = $row['id_mitra'];
        if($id_mitra!=NULL){
            include("navbar.php");
            ?>
                <!doctype html>
                <html class="no-js" lang="zxx">
                <!------ Include the above in your HEAD tag ---------->
                    <main>
                        <div class="container bootstrap snippet mt-4">
                            <div class="col-sm-12">
                                <?php include("postmitra.php") ?>
                            </div>
                        </div><!--/row-->    
                    </main>
                </html>
            <?php
        }else{
            echo '<script language="javascript">';
            echo 'alert("Anda Belum Menjadi Mitra");';
            echo 'window.location = "index.php"';
            echo '</script>';
        }
    }
}else{
    echo '<script language="javascript">';
    echo 'alert("Silahkan Login Terlebih Dahulu");';
    echo 'window.location = "index.php"';
    echo '</script>';
}

?>

