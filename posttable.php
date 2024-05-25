<?php

session_start(); // ketika mulai session harus ada sintak ini dulu

if (!isset($_SESSION['id'])){
require_once("config/connect.php");
include("config/jscss.php");
}

$query = "SELECT *,service.id as nomor FROM `service` join mitra on mitra.id=service.id_mitra where id_client = '$userid'";
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
                    <div class="col-md-12">
                        <div class="table-wrap">
                            <table class="table">              
                                <thead class="thead-primary">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Jasa</th>
                                        <th>Rentang Harga</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    <?php
                                    $fetch_data = mysqli_fetch_all($rql, MYSQLI_BOTH);
                                    foreach($fetch_data as $data){
                                        $imgUrl = "./assets/img/service/".$data['nomor']."/";
                                    ?>   
                                    <tr class="alert" role="alert">
                                        <td>
                                            <img src="<?php echo $imgUrl . $data['foto_jasa']; ?>" height="100"></img>
                                        </td>
                                        <td>
                                            <div class="email">
                                                <a href="service.php?idservice=<?php echo $data['nomor'] ?>" class="streched-link">
                                                    <b><?php echo $data["judul"] ?></b>
                                                </a>
                                            </div>
                                        </td>
                                        <td>Rp<?php echo $data["minharga"] ?>-<?php echo $data["maxharga"] ?></td>
                                        <td>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
