<?php
$servername = "localhost";
$username = "root";  // Username database (biasanya root jika menggunakan XAMPP)
$password = "";      // Password database (kosong jika menggunakan XAMPP)
$dbname = "login_db"; // Nama database yang kamu buat

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
