<?php
session_start(); // Memulai Sesi
session_unset(); // Menghapus semua data sesi
session_destroy(); // Menghancurkan sesi sepenuhnya
header('Location: login.php'); // Arahkan pengguna ke halaman login
exit(); // Menghentikan eksekusi script