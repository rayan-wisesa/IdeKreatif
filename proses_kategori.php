<?php

// Menghubungkan ke file konfigurasi database
include("config.php");

// Memulai sesi untuk menyimpan notifikasi
session_start();

// Proses penambahan kategory baru
if (isset($_POST['simpan'])) {
    // Mengambil data nama kategori dari form
    $category_name = $_POST['category_name'];

    // Query untuk menambahkan data kategori ke dalam database
    $query = "INSERT INTO categories (category_name) VALUES
    ('$category_name')";
    $exec = mysqli_query($conn, $query);

    // Menyimpan notifikasi berhasil atau gagal ke dalam session
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary', // Jenis notifikasi (contoh: primary untuk keberhasilan)
            'message' => 'Kategori berhasil ditambahkan!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger', // Jenis notifikasi (contoh: danger untuk kegagalan)
            'message' => 'Gagal menambahkan kategori: ' . mysqli_error($conn)
        ];
    }
    // Redirect kembali ke halaman kategori
    header('Location: kategori.php');
    exit();
    }


    // Proses penghapusan kategori
    if (isset($_POST['delete'])) {
        // Mengambil ID kategori dari parameter URL
        $catID = $_POST['catID'];

        // Query Untuk menghapus kategori berdasarkan ID
        $exec = mysqli_query($conn, "DELETE FROM categories WHERE category_id='$catID'");

        // Menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
        if ($exec) {
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Kategori berhasil dihapus!'
            ];
            } else {
                $_SESSION['notification'] = [
                    'type' => 'danger',
                    'message' => 'Gagal menghapus kategori: ' . mysqli_error($conn)
                ];
            }
        // Redirect kembali ke halaman kategori
    header('Location: kategori.php');
    exit();
    }

    // Proses pembaruan kategori
    if(isset($_POST['update'])) {
        // Mengambil data dari form pembaruan
        $catID = $_POST['catID'];
        $category_name = $_POST['category_name'];

        // Query untuk memperbarui data kategori berdasarkan ID
        $query = "UPDATE categories SET category_name = '$category_name' WHERE category_id='$catID'";
        $exec = mysqli_query($conn, $query);

        // Menyimpan notifikasi keberhasilan atau kegagalan ke dalam session
        if ($exec) {
        $_SESSION['notification'] = [
        'type' => 'primary',
        'message' => 'Kategori berhasil diperbarui!'
        ];
    } else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal memperbarui kategori : ' . mysqli_error($con)
        ];
    }
    
    // Redirect kembali ke halaman kategori
    header('Location: kategori.php');
    exit();

}
