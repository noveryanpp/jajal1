<?php
session_start();
include('config/connect.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $no_telepon = $_POST['no_telepon'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    $user_id = $_SESSION['id']; // Assuming you store the user's ID in session

    // Validate form data
    $errors = [];

    if (empty($username)) {
        $errors[] = "Username dibutuhkan.";
    }
    if (empty($nama)) {
        $errors[] = "Nama dibutuhkan.";
    }
    if (empty($no_telepon)) {
        $errors[] = "No. Telp Dibutuhkan.";
    }
    if (empty($email)) {
        $errors[] = "Email dibutuhkan.";
    }
    if (!empty($newpassword) && $newpassword != $confirmpassword) {
        $errors[] = "Masukkan Password yang Sama.";
    }

    $uploadOk = 1;
    $fotoProfilName = $_FILES["foto_profil"]["name"];

    if (!empty($fotoProfilName)) {
        if ($_FILES["foto_profil"]["size"] > 1000000) {
            $errors[] = "Ukuran File Terlalu Besar (Max = 1MB).";
            $uploadOk = 0;
        }

        $allowedFormats = ["jpg", "png", "jpeg"];
        $fileExtension = strtolower(pathinfo($fotoProfilName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedFormats)) {
            $errors[] = "Hanya JPG, JPEG, PNG yang diperbolehkan.";
            $uploadOk = 0;
        }
    }

    if (count($errors) == 0 && $uploadOk == 1) {
        // Fetch existing data
        $stmt = $is_connect->prepare("SELECT username, nama, no_telepon, email, alamat, foto_profil FROM client WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($existing_username, $existing_nama, $existing_no_telepon, $existing_email, $existing_alamat, $existing_foto_profil);
        $stmt->fetch();
        $stmt->close();

        // Compare existing data with new data
        $update_needed = false;
        $params = [];
        $sql = "UPDATE client SET ";

        if ($username != $existing_username) {
            $sql .= "username = ?, ";
            $params[] = $username;
            $update_needed = true;
        }
        if ($nama != $existing_nama) {
            $sql .= "nama = ?, ";
            $params[] = $nama;
            $update_needed = true;
        }
        if ($no_telepon != $existing_no_telepon) {
            $sql .= "no_telepon = ?, ";
            $params[] = $no_telepon;
            $update_needed = true;
        }
        if ($email != $existing_email) {
            $sql .= "email = ?, ";
            $params[] = $email;
            $update_needed = true;
        }
        if ($alamat != $existing_alamat) {
            $sql .= "alamat = ?, ";
            $params[] = $alamat;
            $update_needed = true;
        }
        if (!empty($newpassword)) {
            $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql .= "password = ?, ";
            $params[] = $hashed_password;
            $update_needed = true;
        }
        if (!empty($fotoProfilName)) {
            $sql .= "foto_profil = ?, ";
            $params[] = $fotoProfilName;
            $update_needed = true;
        }

        // Remove the last comma and space
        $sql = rtrim($sql, ", ");
        $sql .= " WHERE id = ?";
        $params[] = $user_id;

        if ($update_needed) {
            $stmt = $is_connect->prepare($sql);
            $stmt->bind_param(str_repeat('s', count($params) - 1) . 'i', ...$params);

            if ($stmt->execute()) {
                if (!empty($fotoProfilName)) {
                    $targetDir = "./assets/img/profile/" . $user_id . "/";
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }
                    $targetFile = $targetDir . $fotoProfilName;

                    // Remove old profile picture
                    if (!empty($existing_foto_profil) && file_exists($targetDir . $existing_foto_profil)) {
                        unlink($targetDir . $existing_foto_profil);
                    }

                    if (!move_uploaded_file($_FILES["foto_profil"]["tmp_name"], $targetFile)) {
                        echo '<script>alert("Gagal Mengupload Foto.");</script>';
                    }
                }

                echo '<script language="javascript">';
                echo 'alert("Profil anda telah diperbarui");';
                echo 'window.location = "profile.php?userid='.$user_id.'"';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo 'alert("Gagal Memperbarui, Check Username or Password");';
                echo 'window.location = "editprofile.php"';
                echo '</script>';
            }
            $stmt->close();
        } else {
            echo '<script language="javascript">';
            echo 'alert("Tidak Ada yang Diperbarui");';
            echo 'window.location = "profile.php?userid='.$user_id.'"';
            echo '</script>';
        }
    } else {
        foreach ($errors as $error) {
            echo '<script>alert("'.$error.'"); window.location = "editprofile.php";</script>';
        }
    }
} else {
    echo "Invalid request method.";
}
?>
