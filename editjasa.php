<?php
session_start(); // Start the session

// Redirect to login page if not logged in


require_once("config/connect.php");

$idservice = $_GET['idservice'];

$query = "SELECT service.*, mitra.id_client as idclient FROM service INNER JOIN mitra ON service.id_mitra = mitra.id WHERE service.id = $idservice; ";
$run_sql = mysqli_query($is_connect, $query);
$service = mysqli_fetch_assoc($run_sql);
if (!isset($_SESSION['id'])) {
    echo '<script language="javascript">';
    echo 'alert("Silahkan Login Terlebih Dahulu!");';
    echo 'window.location = "index.php"';
    echo '</script>';
}else{
    $sesid = $_SESSION['id'];
    if($service['idclient']!=$sesid){
        echo '<script language="javascript">';
        echo 'alert("Anda Tidak Bisa Mengedit Jasa Milik Orang Lain!");';
        echo 'window.location = "index.php"';
        echo '</script>';
    }
}
include('navbar.php');
?>

<!doctype html>
<html lang="zxx">

<main>
    <div class="container bootstrap snippet mt-4">
        <div class="row">
            <div class="col-sm-10"><h1>Edit Jasa</h1></div>
            <div class="col-sm-2"></div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="text-center">
                    <img src="./assets/img/service/<?php echo $service['id']; ?>/<?php echo $service['foto_jasa']; ?>" class="w-100" alt="avatar">
                </div>
                <hr><br>
            </div>
            <div class="col-sm-9">
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <hr>
                        <form class="form" action="pros_editjasa.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idservice" value="<?php echo ($service['id']); ?>">
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="judul"><h4>Judul Jasa</h4></label>
                                    <input type="text" class="form-control" name="judul" id="judul" value="<?php echo ($service['judul']); ?>" placeholder="Judul Jasa">
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
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5"><?php echo ($service['deskripsi']); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-6">
                                    <label for="harga"><h4>Rentang Harga</h4></label>
                                    <div class="form-row">
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="minharga" id="minharga" value="<?php echo ($service['minharga']); ?>" placeholder="Harga Minimum">
                                        </div>
                                        <div class="col-6">
                                            <input type="number" class="form-control" name="maxharga" id="maxharga" value="<?php echo ($service['maxharga']); ?>" placeholder="Harga Maximum">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit" name="submit">Update</button>
                                    <button class="btn btn-lg head-btn2" type="reset">Batal</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
