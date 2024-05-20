<?php
// update_profile.php
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
        $errors[] = "<script> alert('Username is Required.') </script>; <script>window.location='editprofile.php';s</script>";
    }
    if (empty($nama)) {
        $errors[] = "<script> alert('Your Name is Required.') </script>; <script>window.location='editprofile.php';s</script>";
    }
    if (empty($no_telepon)) {
        $errors[] = "<script> alert('Number Phone is Required.') </script>; <script>window.location='editprofile.php';s</script>";
    }
    if (empty($email)) {
        $errors[] = "<script> alert('Email is Required.') </script>; <script>window.location='editprofile.php';s</script>";
    }
    if (!empty($newpassword) && $newpassword != $confirmpassword) {
        $errors[] = "<script> alert('password beda') </script>; <script>window.location='editprofile.php';s</script>";
    }

    if (count($errors) == 0) {
        // Fetch existing data
        $stmt = $is_connect->prepare("SELECT username, nama, no_telepon, email, alamat FROM client WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($existing_username, $existing_nama, $existing_no_telepon, $existing_email, $existing_alamat);
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
            $hashed_password = ($newpassword);
            $sql .= "password = ?, ";
            $params[] = $hashed_password;
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
                echo '<script language="javascript">';
                echo 'alert("Profil anda telah diperbarui");';
                echo 'window.location = "profile.php"';
                echo '</script>';
            } else {
                echo '<script language="javascript">';
                echo 'alert("Gagal Memperbarui, Check Username or Password");';
                echo 'window.location = "editprofile.php"';
                echo '</script>';
            }
            $stmt->close();
        } else {
            echo "No changes to update.";
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
} else {
    echo "Invalid request method.";
}
?>
