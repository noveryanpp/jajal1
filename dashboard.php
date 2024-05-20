<?php

session_start(); // ketika mulai session harus ada sintak ini dulu

require_once("config/connect.php");
if(isset($_SESSION['id'])){
    $idclient = $_SESSION['id'];
    $query = mysqli_query($is_connect, "SELECT * FROM client WHERE id = $idclient ");

    if(mysqli_num_rows($query) == 1){
        $row = mysqli_fetch_assoc($query);
        $namalengkap = $row['nama'];
        $username = $row['username'];
        $no_telp = $row['no_telepon'];
        $email = $row['email'];
        $alamat = $row['alamat'];
        $member_since = $row['member_sejak'];
        $fotoprofil = $row['foto_profil'];
    }
}else{
    header('Location: profile.php');
}
include("navbar.php")
?>

<!doctype html>
<html class="no-js" lang="zxx">
    
    
<!------ Include the above in your HEAD tag ---------->
    <?php if(isset($_SESSION['id'])){ ?> 
    <main>
        <div class="container bootstrap snippet mt-4">
        <div class="row">
            <div class="col-sm-8"><h1><?php echo $username; ?></h1></div><!--Username lik-->
            <div class="col-sm-4">
                <a href="editprofile.php" class="btn head-btn2">Edit Profil</a>
                <a href="#mitra" class="btn head-btn1" data-toggle="modal" data-target="#loginmitra">Mitra</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 mt-4"><!--left col-->
                <div class="text-center">
                    <img src="./assets/img/icon/defaultpp.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
            </div></hr><br>            
        </div><!--/col-3-->
            <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <div class="col-xs-6">
                            <p><b>Nama Lengkap :</b> <?php echo $namalengkap; ?></p>
                        </div>           
                        <div class="col-xs-6">
                            <p><b>Nomor Telepon :</b> <?php echo $no_telp; ?></p>
                        </div>
                        <div class="col-xs-6">
                            <p><b>Email :</b> <?php echo $email; ?></p>
                        </div>
                        <div class="col-xs-6">
                            <p><b>Alamat :</b> <?php echo $alamat; ?></p>
                        </div>
                        <div class="col-xs-6">
                            <p><b>Bergabung Sejak :</b> <?php echo $member_since; ?></p>
                        </div>

                <hr>
                </div>
            </div><!--/tab-content-->
            <?php } ?>
            </div><!--/col-9-->
            <div class="col-sm-12">
                <?php include("postmitra.php") ?>
            </div>
        </div><!--/row-->    
    </main>
</html>