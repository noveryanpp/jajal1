<?php

session_start(); // ketika mulai session harus ada sintak ini dulu

require_once("config/connect.php");
$userid=$_GET['userid'];

$query = mysqli_query($is_connect, "SELECT * FROM client WHERE id = '$userid' ");

if(mysqli_num_rows($query) == 1){
    $row = mysqli_fetch_assoc($query);
    $namalengkap = $row['nama'];
    $username1 = $row['username'];
    $no_telp = $row['no_telepon'];
    $email = $row['email'];
    $alamat = $row['alamat'];
    $member_since = $row['member_sejak'];
    $fotoprofil = $row['foto_profil'];
}

include("navbar.php")
?>

<!doctype html>
<html class="no-js" lang="zxx">
    
    
<!------ Include the above in your HEAD tag ---------->
    <main>
        <div class="container bootstrap snippet mt-4">
        <div class="row">
            <div class="col-sm-8"><h1><?php if($username1 != NULL){ echo $username1; }else{ echo "Profil Tidak Ditemukan!";} ?></h1></div><!--Username lik-->
            <?php if(isset($_SESSION['id'])){ if($row['id']==$_SESSION['id']){ if($row['id_mitra'] == NULL){ ?>
            <div class="col-sm-4">
                <a href="editprofile.php" class="btn head-btn2">Edit Profil</a>
                <a href="registermitra.php" class="btn head-btn1" data-toggle="modal" data-target="#registermitra">Daftar Mitra</a>
            </div>
            <?php }else if($row['id_mitra'] != NULL){ ?>
            <div class="col-sm-4">
                <a href="editprofile.php" class="btn head-btn2">Edit Profil</a>
                <a href="dashboard.php" class="btn head-btn1">Dashboard</a>
            </div>
            <?php }}}?>
        </div>
        <div class="row">
            <div class="col-sm-3 mt-4"><!--left col-->
                <div class="text-center">
                    <img src="assets/img/profile/<?php echo $userid; ?>/<?php echo $fotoprofil; ?>" class="avatar img-circle img-thumbnail" alt="avatar">
                </div></hr><br>            
            </div><!--/col-3-->
            <div class="col-sm-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                            <div class="col-xs-6">
                                <p><b>Nama Lengkap :</b> <?php echo $namalengkap; ?></p>
                            </div>           
                            <?php if($row['id_mitra']!=NULL){ ?>
                            <div class="col-xs-6">
                                <p><b>Nomor Telepon :</b> <?php echo $no_telp; ?></p>
                            </div>
                            <div class="col-xs-6">
                                <p><b>Email :</b> <?php echo $email; ?></p>
                            </div>
                            <div class="col-xs-6">
                                <p><b>Alamat :</b> <?php echo $alamat; ?></p>
                            </div>
                            <?php } ?>
                            <div class="col-xs-6">
                                <p><b>Bergabung Sejak :</b> <?php echo $member_since; ?></p>
                            </div>

                        <hr>
                    </div>
                </div><!--/tab-content-->
            </div><!--/col-9-->
            <div class="col-sm-12">
                <?php if($row['id_mitra']!=NULL){
                    include("posttable.php");
                    }
                ?>
            </div>
        </div><!--/row--> 
        </div>
    </main>
</html>