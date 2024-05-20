<?php

include 'config/connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        echo 'Session error: Username not found.';
        exit();
    }

    $password = $_POST['password'] ?? '';
    $nama_sekolah = $_POST['nama_sekolah'] ?? '';
    $no_telepon = $_POST['no_telepon'] ?? '';
    $foto_profil = $_POST['foto_profil'] ?? '';
    $nisnisn = $_POST['nis/nisn'] ?? '';
    $sertifikasi = $_POST['sertifikasi'] ?? '';

    // Validate required fields
    if (empty($nama_sekolah) || empty($no_telepon) || empty($nisnisn)) {
        echo 'All fields except sertifikasi and foto_profil are required.';
        exit();
    }

    // Sanitize input
    $password = ($password);  // Hash the password
    $nama_sekolah = $is_connect->real_escape_string($nama_sekolah);
    $no_telepon = $is_connect->real_escape_string($no_telepon);
    $foto_profil = $is_connect->real_escape_string($foto_profil);
    $nisnisn = $is_connect->real_escape_string($nisnisn);
    $sertifikasi = $is_connect->real_escape_string($sertifikasi);

    // Check if the client exists
    $stmt = $is_connect->prepare("SELECT id FROM client WHERE username = ?");
    if (!$stmt) {
        echo 'Database error: ' . $is_connect->error;
        exit();
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_client);
        $stmt->fetch();
        $stmt->close();

        // Insert into mitra table
        $stmt = $is_connect->prepare("INSERT INTO mitra ( nama_sekolah, no_telepon, foto_profil, `nis/nisn`, sertifikasi, id_client) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo 'Database error: ' . $is_connect->error;
            exit();
        }
        
        $stmt->bind_param($nama_sekolah, $no_telepon, $foto_profil, $nisnisn, $sertifikasi, $id_client);

        if ($stmt->execute()) {
            $mitra_id = $stmt->insert_id;
            $stmt->close();

            // Update client table
            $stmt = $is_connect->prepare("UPDATE client SET id_mitra = ? WHERE username = ?");
            if (!$stmt) {
                echo 'Database error: ' . $is_connect->error;
                exit();
            }
            
            $stmt->bind_param("is", $mitra_id, $username);

            if ($stmt->execute()) {
                header("Location: postmitra.php");
                exit();
            } else {
                "<script> alert('Gagal Mendaftar Sebagai Mitra) </script>; <script>window.location='registermitra.php';s</script>" . $stmt->error;
            }
            
            $stmt->close();
        } else {
            "<script> alert('Gagal Mendaftar Sebagai Mitra) </script>; <script>window.location='registermitra.php';s</script>" . $stmt->error;
            $stmt->close();
        }
    } else {
        echo 'Client not found.';
    }

    $is_connect->close();
} else {
    echo 'Invalid request method.';
}
?>
