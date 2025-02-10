<?php
// Menghubungkan file konfigurasi database
include 'config.php';

// Memulai sesi PHP
session_start();

// Mendapatkan ID pengguna dari sesi
$userId = $_SESSION["user_id"];

// Menangani form untuk menambahkan postingan baru
if (isset($_POST['simpan'])) {
    // Mendapatkan data dari form
    $postTitle = $_POST["post_title"];
    $content = $_POST["content"];
    $categoryId = $_POST["category_id"];

    // Mengatur ditektori penyimpanan file gambar
    $imageDir = "assets/img/uploads/";
    $imageName = $_FILES["image"]["name"]; // Nama file gambar
    $imagePath = $imageDir . basename($imageName); // Path lengkap gambar

    // Memindahkan file gambar yang diunggah ke direktori tujuan
    if (move_uploaded_file($_FILES["image"]["tmp_name"],$imagePath)) {
        // Jika unggahan berhasil, masukkan
        // Data postingan ke dalam database
        $query = "INSERT INTO posts (post_title, content, created_at, category_id, user_id, image_path) VALUES ('$postTitle','$content', NOW(), $categoryId, $userId,'$imagePath')";
        if ($conn->query($query) === TRUE) {
            // Notifikasi berhasil jika postingan berhasil ditambahkan
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Post successfully added.'
            ];
            
        } else {
            // Notifikasi error jika gagal menambahkan postingan
            $_SESSION['notification'] = [
                'type' => 'danger',
                'message' => 'Error adding post: ' . $conn->error
            ];
        }
    } else {
        // Notifikasi error jika unggahan gambar gagal
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Failed to upload image.'
        ];
    }

    // Arahkan ke halaman dashboard setelah selesai
    header('location: dashboard.php');
    exit();
}