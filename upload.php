<?php

session_start(); // ketika mulai session harus ada sintak ini dulu
include('config/connect.php');

if (!isset($_SESSION['id'])) {
    echo '<script language="javascript">';
    echo 'alert("Silahkan Login Terlebih Dahulu!");';
    echo 'window.location = "index.php"';
    echo '</script>';
}else{
    $clientid = $_SESSION['id'];
    $query10 = "SELECT id_mitra FROM client where id = $clientid";
    $resq10 = mysqli_query($is_connect, $query10);
    $resa10 = mysqli_fetch_assoc($resq10);
    if($resa10['id_mitra']==NULL){
        echo '<script language="javascript">';
        echo 'alert("Anda Bukan Mitra!");';
        echo 'window.location = "index.php"';
        echo '</script>';
    }
}
include('navbar.php');

?>

<!doctype html>
<html class="no-js" lang="zxx">
    
<!------ Include the above in your HEAD tag ---------->
    <main>
    <div class="container bootstrap snippet mt-4">
        <div class="row">
            <div class="col-sm-10"><h1>Upload Jasa</h1></div>
            <div class="col-sm-2"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><!--left col-->
                

        <div class="text-center">
            <img src="./assets/img/hero/cindy-removebg.png" class="w-100" alt="avatar">
        </div></hr><br>
            
            </div>
            <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form class="form" action="proses_upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="judul"><h4>Judul Jasa</h4></label>
                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Jasa" title="enter your first name if any.">
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="foto"><h4>Foto Jasa</h4></label>
                                <input type="file" class="form-control" name="fotojasa" id="fotojasa">
                            </div>
                        </div>
            
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="deskripsi"><h4>Deskripsi Jasa</h4></label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="harga"><h4>Rentang Harga</h4></label>
                                <div class="form-row">
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="minharga" id="minharga" placeholder="Harga Minimum" title="Rp0">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" class="form-control" name="maxharga" id="maxharga" placeholder="Harga Maximum" title="Rp999.999.999">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit" name="submit">Upload</button>
                                <button class="btn btn-lg head-btn2" type="reset">Batal</button>
                            </div>
                        </div>
                    </form>
                
                <hr>
                </div>
            </div><!--/tab-content-->

            </div><!--/col-9-->
        </div><!--/row-->    
    </main>