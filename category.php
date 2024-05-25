<?php
require_once("config/connect.php");
include('navbar.php');

$query1 = "SELECT kategori.*, kategori.nama_kategori AS kategori, COUNT(service.id) AS jumlah FROM kategori LEFT JOIN kat_ser ON kategori.id = kat_ser.id_kategori LEFT JOIN service ON service.id = kat_ser.id_service GROUP BY kategori.id";
$result1 = mysqli_query($is_connect, $query1);
$allkate = mysqli_fetch_all($result1, MYSQLI_BOTH);
?>

<!doctype html>
<html>
    <body>
        <div class="our-services pt-5">
            <div class="container">
                <!-- Section Title -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <h2>Telusuri Kategori Teratas</h2>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <?php
                    foreach($allkate as $data) {
                    ?>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-services text-center mb-30">
                            <div class="services-ion">
                                <span class="flaticon-tour"></span>
                            </div>
                            <div class="services-cap">
                                <h5><a href="search.php?search=&category=<?php echo $data['kategori']?>"><?php echo $data["kategori"] ?></a></h5>
                                <span>(<?php echo $data["jumlah"] ?>)</span>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- More Btn -->
                <!-- Section Button -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="browse-btn2 text-center mt-50">
                            <a href="search.php" class="border-btn2 border-bg-white" style="color: #12b83f">Telusuri Semua Jasa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
