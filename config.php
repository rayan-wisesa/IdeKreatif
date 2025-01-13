<?php

// Konfigurasi koneksi database
$host = "localhost"; // Nama host server database
$username = "root"; // Username untuk akses database
$password = ""; // Password untuk akses database
$database = "idekreatif"; // Nama database yang digunakan

// Membuat koneksi ke database menggunakan MySQLi
$conn = mysqli_connect($host, $username, $password, $database);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    //Menampilkan pesan error jika koneksi gagal
    die("Database gagal terkoneksi: " . $conn->connect_error);
}

// Jika koneksi berhasil, script akan terus berjalan tanpa pesan error
?>