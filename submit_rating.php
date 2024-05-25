<?php
require 'config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_client = 24;
    $id_service = 1; // Ideally, this should be dynamic or passed from the form
    $rating = $_POST["rating"];
    $komentar = $_POST["komentar"];
    $tanggal = date("Y-m-d H:i:s");

    // Validate and sanitize inputs
    $rating = filter_var($rating);
    $komentar = filter_var($komentar);

    // Prepare and bind
    $stmt = $is_connect->prepare("INSERT INTO review (id_client, id_service, tanggal, komentar, rating) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $id_client, $id_service, $tanggal, $komentar, $rating);

    if ($stmt->execute()) {
        echo "New Rate added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $is_connect->close();
}
?>
