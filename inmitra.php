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

   <body>
       <div class="modal fade" id="loginmitra" tabindex="-1" role="dialog" aria-labelledby="LoginMitra" aria-hidden="true">
          <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
              <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                  <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem; border-color: transparent;">
                      <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="assets\img\hero\oniel.png"
                            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                          <div class="card-body p-4 p-lg-5 text-black">

                        <form action='proseslogin_mitra.php' method='post'>

                          <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Masuk Mode Mitra</h5>

                          <div class="form-outline mb-4">
                            <input type="password" name='password' class="form-control form-control-lg" />
                            <label class="form-label" for="form2Example27">gdgdgd</label>
                          </div>

                          <div class="pt-1 mb-4">
                            <input type='submit' class="btn btn-dark btn-lg btn-block" value='Masuk'>
                          </div>
                        </form>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="registermitra" tabindex="-1" role="dialog" aria-labelledby="RegMitra" aria-hidden="true">
          <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
              <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                  <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem; border-color: transparent;">
                      <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="assets\img\hero\oniel.png"
                            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                          <div class="card-body p-4 p-lg-5 text-black">
                          <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Bergabung Menjadi Mitra!</h5>

                          <div class="mb-4">
                            <p><b>Keuntungan menjadi Mitra :</b><br>
                            -Mendapatkan Pengalaman Bekerja<br>
                            -Penghasilan Tambahan<br>
                            (Khusus untuk anak SMA/SMK dan Mahasiswa)</p>
                            
                          </div>

                          <div class="pt-1 mb-4">
                            <button class="btn btn-dark btn-lg btn-block">Gabung Sekarang</button>
                          </div>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Header End -->
    </header>

      <!-- JS here -->
	<!--
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
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