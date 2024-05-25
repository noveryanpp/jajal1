<?php

require_once("config/connect.php");
include('config/jscss.php');
$query = "SELECT * FROM `review` join client on client.id=review.id_client join service on service.id=id_service where id_service='$idservice';";

$run_sql = mysqli_query($is_connect, $query);
//var_dump($sql);
$total_reviews = 0;
$total_five_star_reviews = 0;
$total_four_star_reviews = 0;
$total_three_star_reviews = 0;
$total_two_star_reviews = 0;
$total_one_star_reviews = 0;

$idservice = $_GET['idservice'];
$querye = "SELECT rating, COUNT(rating) as count FROM review join service on service.id=review.id_service where id_service = '$idservice' GROUP BY rating;";
$result = mysqli_query($is_connect, $querye);

$query2 = "SELECT mitra.id_client as idclient FROM service INNER JOIN mitra ON service.id_mitra = mitra.id WHERE service.id = $idservice;";
$runquery2 = mysqli_query($is_connect, $query2);
$resq2 = mysqli_fetch_assoc($runquery2);
$idcser = $resq2['idclient'];

while ($row = mysqli_fetch_assoc($result)) {
    $total_reviews += $row['count'];
    if ($row['rating'] == 5) {
        $total_five_star_reviews = $row['count'];
    } elseif ($row['rating'] == 4) {
        $total_four_star_reviews = $row['count'];
    } elseif ($row['rating'] == 3) {
        $total_three_star_reviews = $row['count'];
    } elseif ($row['rating'] == 2) {
        $total_two_star_reviews = $row['count'];
    } elseif ($row['rating'] == 1) {
        $total_one_star_reviews = $row['count'];
    }
}

$five_star_percentage = $total_reviews ? ($total_five_star_reviews / $total_reviews) * 100 : 0;
$four_star_percentage = $total_reviews ? ($total_four_star_reviews / $total_reviews) * 100 : 0;
$three_star_percentage = $total_reviews ? ($total_three_star_reviews / $total_reviews) * 100 : 0;
$two_star_percentage = $total_reviews ? ($total_two_star_reviews / $total_reviews) * 100 : 0;
$one_star_percentage = $total_reviews ? ($total_one_star_reviews / $total_reviews) * 100 : 0;

?>


<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
</head>
<body>
    <div class="container">
    	<h3 class="mb-3">Rating & Masukan</h1>
    	<div class="card">
    		<div class="card-header"><b><?php echo $data['judul'] ?></b> by <b><?php echo $data['nama_penjual'] ?></b></div>
    		<div class="card-body">
                <?php
                    $query5 = "SELECT COUNT(review.id) AS jumlah_review FROM review JOIN service on service.id=review.id_service where id_service = '$idservice';";
                    $runql = mysqli_query($is_connect, $query5);
                    $query6 = "SELECT AVG(rating) as rata_rating FROM review where id_service = '$idservice';";
                    $runql2 = mysqli_query($is_connect, $query6);
                ?>
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
                        <?php
                            $fetch_data3 = mysqli_fetch_all($runql2, MYSQLI_BOTH);
                            foreach($fetch_data3 as $data3){
                        ?>
    						<b><span id="average_rating">
                            <?php 
                                $rata=$data3["rata_rating"];
                                $hasil = round($rata, 1);
                                echo $hasil; 
                            
                            ?></span> / 5</b>
    					</h1>
    					<div class="mb-3">
                            <?php
                            $rating = $data3["rata_rating"];
                            for ($i = 1; $i <= floor($rating); $i++) {
                                echo '<i class="fas fa-star text-warning mr-1"></i>';
                            }
                            if ($rating - floor($rating) >= 0.5) {
                                echo '<i class="fas fa-star-half-alt text-warning mr-1"></i>';
                            }
                            for ($i = round($rating); $i < 5; $i++) {
                                echo '<i class="fas fa-star star-light mr-1"></i>';
                            }
                            ?>
	    				</div>
                        <?php }
                        ?>
                        <?php
                            $fetch_data2 = mysqli_fetch_all($runql, MYSQLI_BOTH);
                            foreach($fetch_data2 as $data2){
                        ?>
    					<h3><span id="total_review"><?php echo $data2["jumlah_review"] ?></span> Review</h3>
    				</div>
    				<div class="col-sm-4">
                         <p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review"><?php echo $total_five_star_reviews; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $five_star_percentage; ?>%" aria-valuenow="<?php echo $five_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review"><?php echo $total_four_star_reviews; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $four_star_percentage; ?>%" aria-valuenow="<?php echo $four_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review"><?php echo $total_three_star_reviews; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $three_star_percentage; ?>%" aria-valuenow="<?php echo $three_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review"><?php echo $total_two_star_reviews; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $two_star_percentage; ?>%" aria-valuenow="<?php echo $two_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review"><?php echo $total_one_star_reviews; ?></span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $one_star_percentage; ?>%" aria-valuenow="<?php echo $one_star_percentage; ?>" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    				</div>
    				<div class="col-sm-4 text-center">
    					<h5 class="mt-4 mb-3">Tambahkan Rating Anda</h5>
                        <?php if(!isset($_SESSION['id'])){ ?>
                        <button type="button" name="review_modal" id="review_modal" class="btn btn-primary" onclick="alert('Silahkan Login Terlebih Dahulu')">Rating</button>
                        <?php }elseif($_SESSION['id']==$idcser){ ?>
                        <button type="button" name="review_modal" id="review_modal" class="btn btn-primary" onclick="alert('Tidak Bisa Memberi Rating Ke Jasa Milik Anda')">Rating</button>
                        <?php }else{ ?>
    					<button type="button" name="review_modal" id="review_modal" class="btn btn-primary" data-toggle="modal" data-target="#review">Rating</button>
                        <?php } ?>
    				</div>
    			</div>
                <?php }
                ?>
    		</div>
    	</div>
    	<div class="mt-5" id="review_content">
        <?php
                $fetch_data = mysqli_fetch_all($run_sql, MYSQLI_BOTH);
                foreach($fetch_data as $data){
            ?>
        <div class="row mb-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <b><?php echo $data["username"] ?></b>
                </div>
                <div class="card-body">
                <?php
                    $rating = $data["rating"];
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                            echo '<i class="fas fa-star text-warning mr-1"></i>';
                        } else {
                            echo '<i class="fas fa-star star-light mr-1"></i>';
                        }
                    }
                    ?>
                    <?php echo $data["komentar"] ?>
                </div>
                <div class="card-footer text-right">
                <?php 
                    $tanggal = $data["tanggal"];
                    $dateTime = new DateTime($tanggal);
                    $formattedDate = $dateTime->format('Y l, F j, H:i:s A');
                    echo $formattedDate;
                    ?>
                </div>
            </div>
        </div>
        </div>
        <?php }
        ?>
        </div>
    </div>
</body>
</html>

<div class="modal pt-5" id="review" tabindex="-1" role="dialog" aria-labelledby="review" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Tambahkan Rating Anda</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
            <form action='tesreting11.php?idservice=<?php echo $idservice ?>' method='post'>
	      	<div class="modal-body">
              <div class="form-group">
                <div class="tengah">
                    <div class="rateyo" id= "rating"
                        data-rateyo-rating="0"
                        data-rateyo-num-stars="5"
                        data-rateyo-score="3">
                    </div>
                    <span class='result'></span>
                    <input type="hidden" name="rating">
	        	</div>
                </div>
	        	<div class="form-group">
	        		<textarea name="komentar" id="komentar" class="form-control" placeholder="Tambahkan Masukan Anda"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
                    <div><input type="submit" name="add" class="btn btn-primary" value="Kirim Rating"/> </div>
	        	</div>
	      	</div>
            </form>
    	</div>
  	</div>
</div>



<style>


.progress-label-left {
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
}
.progress-label-right {
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
}
.star-light {
    color: #e9ecef;
}
.progress {
    height: 20px;
}
.progress-bar {
    line-height: 20px;
}
.tengah
{
    display: flex;
    flex-direction: column;
    align-items: center;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

<script>
        $(function () {
            $(".rateyo").rateYo({
                rating: 4,
                numStars: 5,
                fullStar: true
            }).on("rateyo.change", function (e, data) {
                var rating = data.rating;
                $(this).parent().find('.result').text('rating: ' + rating);
                $(this).parent().find('input[name=rating]').val(rating); // add rating value to hidden input field
            });
        });
</script>