<?php

include 'koneksi.php';

// Ambil data dari form
$nama = trim($_POST['nama']);
$harga = trim($_POST['harga']);
$deskripsi = trim($_POST['deskripsi']);
$kategori = trim($_POST['kategori']);

// Validasi sederhana: pastikan tidak kosong
if (empty($nama) || empty($harga) || empty($deskripsi) || empty($kategori)) {
    echo "Semua field harus diisi!";
    echo "<a href='tambah_produk.html'><button>Kembali</button></a>";
    exit; // hentikan eksekusi agar tidak lanjut ke query
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO produk (nama, harga, deskripsi, kategori) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siss", $nama, $harga, $deskripsi, $kategori);

if ($stmt->execute()) {
    echo "Produk berhasil disimpan.<br>";
    echo "Nama: $nama <br>";
    echo "Harga: Rp " . number_format($harga, 0, ',', '.') . "<br>";
    echo "Deskripsi: $deskripsi <br>";
    echo "Kategori: $kategori <br>";
    echo "<a href='index.php'><button>Kembali</button></a>";
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
    echo "<a href='tambah_produk.html'><button>Kembali</button></a>";
}

$stmt->close();
$conn->close();
?>