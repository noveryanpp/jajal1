<?php

//session_start(); // ketika mulai session harus ada sintak ini dulu

require_once("config/connect.php");
include("navbar.php");
$query = "select service.*,client.nama as nama_penjual,mitra.foto_profil as profil_mitra, mitra.nama_sekolah as sekolah,client.email as email,mitra.no_telepon as no_telepon, client.alamat as alamat from service join mitra on mitra.id=service.id_mitra inner join client on client.id=mitra.id_client where service.id = 1;";

$run_sql = mysqli_query($is_connect, $query);
//var_dump($sql);
?>


<!doctype html>
<html class="no-js" lang="zxx">
   <body>
        <!-- job post company Start -->
        <div class="job-post-company pt-5 pb-120">
            <div class="container">
            <?php
                $fetch_data = mysqli_fetch_all($run_sql, MYSQLI_BOTH);
                foreach($fetch_data as $data){
            ?>
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-7 col-lg-8">
                        <div class="job-tittle">
                            <h1><?php echo $data["judul"] ?></h1>
                        </div> 

                        <!-- job single -->
                        <div class="single-job-items">
                            <div class="job-items">
                                <div class="company-img company-img-details">
                                    <a href="#"><img src="assets/img/blog/author.png" style="width: 80px" alt=""></a>
                                </div>
                                <div class="job-tittle">
                                    <a href="#">
                                        <h4><?php echo $data["nama_penjual"] ?></h4>
                                    </a>
                                    <ul>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                            4.7
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                              <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                            </svg>
                                            Depok, Sleman
                                        </li>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                                              <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                                            </svg>
                                            <?php echo $data["sekolah"] ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                          <!-- job single End -->
                        <div id="carouselExampleIndicators" class="carousel slide mb-50" data-ride="carousel">
                          <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                          </ol>
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img class="d-block w-100" src="./assets/img/elements/16x9.svg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="./assets/img/elements/16x9.svg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="./assets/img/elements/16x9.svg" alt="Third slide">
                            </div>
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>

                       
                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Deskripsi Jasa</h4>
                                </div>
                                <p><?php echo $data["deskripsi"] ?></p>
                            </div>
                        </div>

                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Detail Jasa</h4>
                           </div>
                          <ul>
                              <li>Diunggah Pada :  <?php echo $data["tanggal_upload"] ?></li>
                              <li>Lokasi :  <?php echo $data["alamat"] ?></li>
                              <li>Harga :  Rp<?php echo $data["minharga"] ?> - Rp<?php echo $data["maxharga"] ?></li>
                          </ul>
                         <div class="apply-btn2">
                            <a href="#" class="btn">Hubungi Penjual</a>
                         </div>
                       </div>
                        <div class="post-details4  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Informasi Penjual</h4>
                           </div>
                                <?php echo $data["nama_penjual"] ?>
                              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                            <ul>
                                <li>Nama :   <?php echo $data["nama_penjual"] ?></li>
                                <li>Email :   <?php echo $data["email"] ?></li>
                                <li>No. Telp :   <?php echo $data["no_telepon"] ?></li>
                            </ul>
                       </div>
                    </div>
                </div>
            </div>
            <?php }
            ?>
        </div>
        <!-- job post company End -->
        <?php include('reting.php') ?>
    </main>
    </body>
</html>