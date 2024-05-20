<?php

session_start(); // ketika mulai session harus ada sintak ini dulu

if (!isset($_SESSION['id'])) 
require_once("config/connect.php");
?>

<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
         <title>Job board HTML-5 Template </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
                <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

                <!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/price_rangs.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
   </head>
   <header>
        <!-- Header Start -->
       <div class="header-area header-transparrent">
           <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo1.png" class="w-50" alt=""></a>
                            </div>  
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="index.php">Beranda</a></li>
                                            <li><a href="job_listing.php">Cari Jasa</a></li>
                                            <li><a href="about.php">Tentang Kami</a></li>
                                            <li><a href="contact.php">Kontak</a></li>
                                        </ul>
                                    </nav>
                                </div>          
                                <!-- Header-btn -->
                                <div class="header-btn d-none f-right d-lg-block">
                                    <?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) )
                                        {
                                    ?>
						<nav class="navbar navbar-expand-sm">
						  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="navbar-toggler-icon"></span>
						  </button>
						  <div class="collapse navbar-collapse" id="navbar-list-4">
						    <ul class="navbar-nav">
						        <li class="nav-item dropdown">
						        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          <img src="./assets/img/icon/defaultpp.jpg" width="40" height="40" class="rounded-circle">
						        </a>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						          <a class="dropdown-item" href="#">Dashboard</a>
						          <a class="dropdown-item" href="#">Edit Profile</a>
						          <a class="dropdown-item" href="logout.php">Log Out</a>
						        </div>
						      </li>   
						    </ul>
						  </div>
						</nav>

                                    <?php }else{ ?>
                                        <a href="#login" class="btn head-btn2" data-toggle="modal" data-target="#modallogin">Masuk</a>
                                        <a href="#register" class="btn head-btn1" data-toggle="modal" data-target="#modalregister">Daftar</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
        <!-- Header End -->
    </header>
    
    
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
                    <form class="form" action="proses_upload.php" method="post" id="registrationForm">
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="judul"><h4>Judul Jasa</h4></label>
                                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Jasa" title="enter your first name if any.">
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="foto"><h4>Foto Jasa</h4><p>(Maksimal 3 Foto)</p></label>
                                <input type="file" class="form-control text-center center-block file-upload mb-1" name="foto_produk" id="foto_produk">
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
                                    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i>Upload</button>
                                    <button class="btn btn-lg head-btn2" type="reset"><i class="glyphicon glyphicon-repeat"></i>Batal</button>
                                </div>
                        </div>
                    </form>
                
                <hr>
                </div>
            </div><!--/tab-content-->

            </div><!--/col-9-->
        </div><!--/row-->    
    </main>