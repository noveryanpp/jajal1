<?php

require_once("config/connect.php");

session_start(); // Ensure the session is started

if (!isset($_SESSION['id'])) {
    die("User not authenticated.");
}

if (isset($_POST["rating_data"])) {

    // Ensure database connection is valid
    if (!$is_connect) {
        die("Database connection failed.");
    }

    // Prepare the data
    $id_client = $_SESSION['id'];
    $id_service = 1; // This should ideally be dynamic or passed from the form
    $rating = $_POST["rating"];
    $komentar = $_POST["komentar"];
    $tanggal = date("Y-m-d H:i:s"); // Current date and time

    // Use prepared statements to prevent SQL injection
    $stmt = $is_connect->prepare("
        INSERT INTO review (id_client, id_service, tanggal, komentar, rating) 
        VALUES (?, ?, ?, ?, ?)
    ");
    
    $stmt->bind_param("iissi", $id_client, $id_service, $tanggal, $komentar, $rating);
    
    if ($stmt->execute()) {
        echo "Your Review & Rating Successfully Submitted";
    } else {
        echo "Error submitting your review.";
    }

    $stmt->close();
}

if (isset($_POST["action"])) {

    // Ensure database connection is valid
    if (!$is_connect) {
        die("Database connection failed.");
    }

    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    $query = "
        SELECT * FROM review 
        ORDER BY id DESC
    ";

    $result = $is_connect->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $review_content[] = array(
                'id_client' => $row["id_client"],
                'komentar' => $row["komentar"],
                'rating' => $row["rating"],
                'tanggal' => date('l jS, F Y h:i:s A', strtotime($row["tanggal"]))
            );

            switch ($row["rating"]) {
                case '5':
                    $five_star_review++;
                    break;
                case '4':
                    $four_star_review++;
                    break;
                case '3':
                    $three_star_review++;
                    break;
                case '2':
                    $two_star_review++;
                    break;
                case '1':
                    $one_star_review++;
                    break;
            }

            $total_review++;
            $total_user_rating += $row["rating"];
        }

        if ($total_review > 0) {
            $average_rating = $total_user_rating / $total_review;
        }

        $output = array(
            'average_rating' => number_format($average_rating, 1),
            'total_review' => $total_review,
            'five_star_review' => $five_star_review,
            'four_star_review' => $four_star_review,
            'three_star_review' => $three_star_review,
            'two_star_review' => $two_star_review,
            'one_star_review' => $one_star_review,
            'review_data' => $review_content
        );

        echo json_encode($output);
    } else {
        echo json_encode(array("error" => "Failed to fetch reviews."));
    }
}

?>
