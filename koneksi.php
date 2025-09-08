<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "ecommerce";

// Membuat koneksi
$conn = mysqli_connect($host, $username, $password, $db);

// Cek koneksi
if (!$conn) {
    die ("Koneksi gagal!" . mysqli_connect_error());
}
echo "Konek berhasil!";
?>