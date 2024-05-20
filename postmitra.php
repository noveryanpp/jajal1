<?php

session_start(); // ketika mulai session harus ada sintak ini dulu

if (!isset($_SESSION['id'])){
require_once("config/connect.php");
include("config/jscss.php");
}

$query = "SELECT *,service.id as nomor FROM `service` join mitra on mitra.id=service.id_mitra where id_client =" . $_SESSION['id'];
$rql = mysqli_query($is_connect, $query);

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Table 06</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10">
                        <h3>Daftar Jasa</h3>
                    </div>
                    <div class="col-sm-2">
                        <a href="upload.php" class="btn btn-head-btn1">Tambah Jasa</a>
                    </div>
                    <div class="col-md-12">
                        <div class="table-wrap">
                            <table class="table">
                            <?php
                                $fetch_data = mysqli_fetch_all($rql, MYSQLI_BOTH);
                                    foreach($fetch_data as $data){
                                    ?>                 
                                <thead class="thead-primary">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Jasa</th>
                                        <th>Rentang Harga</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    <tr class="alert" role="alert">
                                        <td>
                                            <img src="assets/img/gallery/1.png" height="100"></img>
                                        </td>
                                        <td>
                                            <div class="email">
                                                <span><?php echo $data["judul"] ?></span>
                                            </div>
                                        </td>
                                        <td>Rp<?php echo $data["minharga"] ?>-<?php echo $data["maxharga"] ?></td>
                                        <td>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true"><i class="fa fa-edit"></i></span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
