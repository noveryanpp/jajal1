<?php

session_start(); // ketika mulai session harus ada sintak ini dulu
require_once("config/connect.php");
if(isset($_SESSION['id'])){
    $idclient = $_SESSION['id'];
    $query = mysqli_query($is_connect, "SELECT * FROM client WHERE id = $idclient ");

    if(mysqli_num_rows($query) == 1){
        $row = mysqli_fetch_assoc($query);
        $fotoprofil = $row['foto_profil'];
    }
}else{
  header('Location: index.php');
}
?>

<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
         <title>Jajal</title>
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
    <header>
        <!-- Header Start -->
       <div class="header-area header-transparrent">
           <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/logo1.png" class="w-50"alt=""></a>
                            </div>  
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="index.php">Beranda</a></li>
                                            <li><a href="search.php">Cari Jasa</a></li>
                                            <li><a href="category.php">Kategori</a></li>
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
						  <div id="pp">
						    <a href="profile.php?userid=<?php echo $_SESSION['id'] ?>">
						          <img src="assets/img/profile/<?php echo $idclient; ?>/<?php echo $fotoprofil; ?>" width="60" height="50" class="rounded-circle">
                            </a>
						  </div>
						</nav>

                                    <?php }else{ ?>
                                        <a href="#login" class="btn head-btn2" id="login" data-toggle="modal" data-target="#modallogin">Masuk</a>
                                        <a href="#register" class="btn head-btn1" id="register" data-toggle="modal" data-target="#modalregister">Daftar</a>
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
       <div class="modal fade" id="modallogin" tabindex="-1" role="dialog" aria-labelledby="LoginModal" aria-hidden="true">
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

                        <form action='proses_login.php' method='post'>

                          <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Masuk ke Akun Anda</h5>

                          <div class="form-outline mb-4">
                            <input type="text" name='username' class="form-control form-control-lg" />
                            <label class="form-label" for="form2Example17">Pengguna</label>
                          </div>

                          <div class="form-outline mb-4">
                            <input type="password" name='password' class="form-control form-control-lg" />
                            <label class="form-label" for="form2Example27">Kata Sandi</label>
                          </div>

                          <div class="pt-1 mb-4">
                            <input type='submit' class="btn btn-dark btn-lg btn-block" value='Masuk'>
                          </div>

                          <div class="d-flex align-items-center justify-content-center">
                            <p class="fs-4 mb-0 fw-bold">Belum punya akun?</p>
                            <a class="text-primary fw-bold ms-2" href=#register class="btn head-btn1" data-toggle="modal" data-target="#modalregister">Buat Akun</a>
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

        <div class="modal fade" id="modalregister" tabindex="-1" role="dialog" aria-labelledby="RegisterModal" aria-hidden="true">
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

                            <form action='proses_register.php' method='post'>

                              <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Daftar Akun</h5>

                              <div class="form-outline mb-4">
                                <input type="text" name="username" class="form-control form-control-lg" />
                                <label class="form-label" for="username">Username</label>
                              </div>

                              <div class="form-outline mb-4">
                                <input type="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="password">Password</label>
                              </div>

                              <div class="form-outline mb-4">
                                <input type="text" name="nama" class="form-control form-control-lg" />
                                <label class="form-label" for="nama">Nama Lengkap</label>
                              </div>

                              <div class="form-outline mb-4">
                                <input type="text" name="no_telepon" class="form-control form-control-lg" />
                                <label class="form-label" for="no_telepon">No. Telepon</label>
                              </div>

                              <div class="form-outline mb-4">
                                <input type="text" name="alamat" class="form-control form-control-lg" />
                                <label class="form-label" for="email">Alamat</label>
                              </div>

                              <div class="form-outline mb-4">
                                <input type="email" name="email" class="form-control form-control-lg" />
                                <label class="form-label" for="email">Email</label>
                              </div>

                              <div class="pt-1 mb-4">
                              <button name='register' class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Daftar</button>
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

        <div class="modal fade" id="loginmitra" tabindex="-1" role="dialog" aria-labelledby="LoginMitra" aria-hidden="true">
          <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
              <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                  <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem; border-color: transparent;">
                      <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                          <img src="assets\img\hero\oniel.png" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                          <div class="card-body p-4 p-lg-5 text-black">

                            <form action='proseslogin_mitra.php' method='post'>

                              <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Masuk Mode Mitra</h5>

                              <div class="form-outline mb-4">
                                <input type="password" name='password' class="form-control form-control-lg" />
                                <label class="form-label" for="form2Example27">Masukkan Password Mitra</label>
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
                              <a href="registermitra.php" class="btn btn-dark btn-lg btn-block">Gabung Sekarang</a>
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