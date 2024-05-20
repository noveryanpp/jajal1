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
}
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

                              <div class="form-outline mb-4">
                                <input type="file" name="foto_profil" class="form-control form-control-lg" />
                                <label class="form-label" for="email">Foto Profil</label>
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

        <div class="container bootstrap snippet mt-4">
        <div class="row">
            <div class="col-sm-10"><h1><?php echo $username; ?></h1></div>
            <div class="col-sm-2"></div>
        </div>
        <div class="row">
            <div class="col-sm-3"><!--left col-->
                

        <div class="text-center">
            <img src="./assets/img/icon/defaultpp.jpg" class="avatar img-circle img-thumbnail" alt="avatar">
            <h6>Upload a different photo...</h6>
            <input type="file" class="text-center center-block file-upload">
        </div></hr><br>

                
            <div class="panel panel-default">
                <div class="panel-heading"><p><b>Member Since :</b> <?php echo $member_since; ?></p></div>
            </div>
            
            </div><!--/col-3-->
            <div class="col-sm-9">
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form class="form" action="editprof.php" method="post" id="registrationForm">
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="first_name"><h4>Username</h4></label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="<?php echo $username; ?>" title="enter your first name if any.">
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="last_name"><h4>Nama Lengkap</h4></label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="<?php echo $namalengkap; ?>" title="enter your last name if any.">
                            </div>
                        </div>
            
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="phone"><h4>No. Telp</h4></label>
                                <input type="text" class="form-control" name="no_telepon" id="no_telepon" placeholder="<?php echo $no_telp; ?>" title="enter your phone number if any.">
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="col-xs-6">
                                <label for="email"><h4>Email</h4></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo $email; ?>" title="enter your email.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="text"><h4>Alamat</h4></label>
                                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="<?php echo $alamat; ?>" title="enter a location">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="password"><h4>Password Baru</h4></label>
                                <input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Masukkan Password Baru" title="Enter a new password.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="confirmpassword"><h4>Konfirmasi Password</h4></label>
                                <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="Konfirmasi Password Baru" title="Confirm your new password.">
                            </div>
                        </div>
                        <div class="form-group">
                        <div class="col-xs-12">
                            
                        </div>
                        <div class="form-group">
                        <div class="form-group">
                            <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Simpan</button>
                                    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Batal</button>
                                </div>
                        </div>
                    </form>
                
                <hr>
                </div>
            </div><!--/tab-content-->

            </div><!--/col-9-->
        </div><!--/row-->    
    </main>