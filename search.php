<?php
session_start();
require_once("config/connect.php");

$queryc = "SELECT * FROM kategori";
$resultc = mysqli_query($is_connect, $queryc);
$categories = mysqli_fetch_all($resultc, MYSQLI_ASSOC);

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $kategori = $_GET['category'];
    if($kategori== "all"){
        $query1 = "SELECT service.*, client.nama AS namapenjual, review_counts.jumlah_review, avg_rating.rata_rating,
        kategori.nama_kategori AS kategori FROM service INNER JOIN client ON service.id_mitra = client.id_mitra LEFT 
        JOIN (SELECT id_service, COUNT(id) AS jumlah_review FROM review GROUP BY id_service) AS review_counts ON 
        service.id = review_counts.id_service LEFT JOIN (SELECT id_service, AVG(rating) AS rata_rating FROM review 
        GROUP BY id_service) AS avg_rating ON service.id = avg_rating.id_service LEFT JOIN kat_ser ON service.id = kat_ser.id_service 
        LEFT JOIN kategori ON kat_ser.id_kategori = kategori.id where service.judul LIKE '%". $search ."%'";
    }else{
        $query1 = "SELECT service.*, client.nama AS namapenjual, review_counts.jumlah_review, avg_rating.rata_rating,
     kategori.nama_kategori AS kategori FROM service INNER JOIN client ON service.id_mitra = client.id_mitra LEFT 
     JOIN (SELECT id_service, COUNT(id) AS jumlah_review FROM review GROUP BY id_service) AS review_counts ON 
     service.id = review_counts.id_service LEFT JOIN (SELECT id_service, AVG(rating) AS rata_rating FROM review 
     GROUP BY id_service) AS avg_rating ON service.id = avg_rating.id_service LEFT JOIN kat_ser ON service.id = kat_ser.id_service 
     LEFT JOIN kategori ON kat_ser.id_kategori = kategori.id where service.judul LIKE '%". $search ."%' AND kategori.nama_kategori LIKE '%". $kategori ."%'";
    } // 
} else {
    $query1 = "SELECT service.*, client.nama as namapenjual, review_counts.jumlah_review, avg_rating.rata_rating 
    FROM service INNER JOIN client ON service.id_mitra = client.id_mitra LEFT JOIN (SELECT id_service, COUNT(id) 
    AS jumlah_review FROM review GROUP BY id_service) AS review_counts ON service.id = review_counts.id_service LEFT 
    JOIN (SELECT id_service, AVG(rating) AS rata_rating FROM review GROUP BY id_service) AS avg_rating ON service.id = avg_rating.id_service;";
}

$result1 = mysqli_query($is_connect, $query1);
$allSer = mysqli_fetch_all($result1, MYSQLI_BOTH);
include("navbar.php");
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
    <main>
        <div class="row justify-content-center mt-5">
            <div class="col-xl-10">
                <form action="search.php" method="GET" class="search-box">
                    <div class="row row-eq-height input-form">
                        <input type="text" name="search" placeholder="Nama Jasa atau Kata Kunci">
                    </div>
                    <div class="select-form">
                        <div class="row row-eq-height select-itms">
                            <select name="category">
                                <option value="all">Semua Kategori</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo $category['nama_kategori']; ?>"><?php echo $category['nama_kategori']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row row-eq-height search-form">
                        <input class="btn btn-head-btn1" type="submit" value="Cari Jasa"></input>
                    </div>
                </form>
            </div>
        </div>
        <div class="job-listing-area pt-30 pb-120">
            <div class="container">
                <div class="row">
                    <!-- Left content -->
                    <?php
                    $query6 = "SELECT COUNT(service.id) AS jumlahjasa FROM service";
                    $runql2 = mysqli_query($is_connect, $query6);
                    ?>
                    <!-- Right content -->
                    <div class="col">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                <!-- Count of Job list Start -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="count-job mb-35">
                                            <?php if(isset($_GET['search'])){?>
                                            <span>Hasil Pencarian Dari : <?php echo $search; ?></span>
                                            <?php } else {
                                                foreach($runql2 as $dt) ?>
                                            <span><?php echo $dt['jumlahjasa']?> Jobs found</span>
                                            <?php } ?>
                                            <span>Kategori : <?php echo $kategori ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Count of Job list End -->
                                <!-- single-job-content -->
                                <div class="card-deck">
                                <?php if (empty($allSer)) { ?>
                                    <div class="col-12 text-center">
                                        <h4>Jasa Tidak Ditemukan</h4>
                                    </div>
                                <?php } ?>
                                <?php
                                    
                                    foreach($allSer as $service){
                                        $imgUrl = "./assets/img/service/".$service['id']."/";
                                    
                                ?>
                                <div class="col-lg-4 mb-4">
                                  <div class="card p-3">
                                      <div class="about-product">
                                          <div>
                                              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                  <div class="carousel-inner">
                                                      <div class="carousel-item active">
                                                          <img class="d-block w-100" style="height: 200px; object-fit: cover;" src="<?php echo $imgUrl; echo $service['foto_jasa'] ?>"></img>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div>
                                              <a href="service.php?idservice=<?php echo $service['id']?>" class="stretched-link">
                                                <h5 class="mt-1"><?php echo $service['judul'] ?></h5>
                                              </a>
                                              <a href="service.php?idservice=<?php echo $service['id']?>"><p>by <b><?php echo $service['namapenjual'] ?></b></p></a>
                                          </div>
                                      </div>
                                      <div class="">
                                                <small class="text-muted"><i class="fas fa-star text-warning mr-1"></i><?php 
                                                        $rata=$service["rata_rating"];
                                                        $hasil = round($rata, 1);
                                                        echo $hasil; 
                                                        ?> 
                                                        (<?php echo $service['jumlah_review'] ?>)
                                                </small>
                                      </div>
                                      <div class="d-flex justify-content-between total font-weight-bold mt-4"><span>Mulai dari :</span><span><?php echo $service['minharga'] ?></span></div>
                                  </div>
                                </div>

                                
                                <?php } ?>
                                </div>

                            </div>
                        </section>
                        <!-- Featured_job_end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Job List Area End -->

	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Range -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <script src="./assets/js/price_rangs.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        
    </body>
</html>
