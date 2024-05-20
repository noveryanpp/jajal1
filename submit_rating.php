<?php

//submit_rating.php

require_once("config/connect.php");

if(isset($_POST["rating_data"]))
{

	$data = array(
		$id_client= $_SESSION['id'],
		$id_service	= 1,
		$rating =$_POST["rating"],
		$komentar =$_POST["komentar"],
		$tanggal =now()
	);

	$query = "
	INSERT INTO review
	(`id_client`, `id_service`, `tanggal`, `komentar`, `rating`) 
	VALUES ($id_client, $id_service,$tanggal, $komentar, $rating)
	";

	$statement=mysqli_query($is_connect,$query);

	echo "Your Review & Rating Successfully Submitted";
	echo 'Database error: ' . $is_connect->error;
}
