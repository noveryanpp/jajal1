<?php

require_once("config/connect.php");
$query = "SELECT * FROM `review` join client on client.id=review.id_client join service on service.id=id_service where review.id=2;";

$run_sql = mysqli_query($is_connect, $query);
//var_dump($sql);
?>


<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
    <div class="container">
    	<h1 class="mt-5 mb-5">Review & Rating</h1>
    	<div class="card">
    		<div class="card-header">Sample Product</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
    						<b><span id="average_rating">0</span> / 5</b>
    					</h1>
    					<div class="mb-3">
    						<i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
	    				</div>
    					<h3><span id="total_review">0</span> Review</h3>
    				</div>
    				<div class="col-sm-4">
    					<p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div>
    				<div class="col-sm-4 text-center">
    					<h3 class="mt-4 mb-3">Tambahkan Review Anda</h3>
    					<button type="button" name="review_modal" id="review_modal" class="btn btn-primary" data-toggle="modal" data-target="#review">Review</button>
    				</div>
    			</div>
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
	        	<h5 class="modal-title">Submit Review</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
            <form action='tesreting11.php' method='post'>
	      	<div class="modal-body">
              <div class="form-group">
	        		<textarea name="rating" id="rating" class="form-control" placeholder="no"></textarea>
	        	</div>
	        	<div class="form-group">
	        		<textarea name="komentar" id="komentar" class="form-control" placeholder="Masukkan Komentar Anda"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
	        		<button type="submit" name="rating_data"class="btn btn-primary" >Submit</button>
	        	</div>
	      	</div>
            </form>
    	</div>
  	</div>
</div>



<style>
.progress-label-left
{
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
}
.progress-label-right
{
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
}
.star-light
{
	color:#e9ecef;
}
</style>