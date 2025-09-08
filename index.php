<?php
include 'koneksi.php';

// Ambil kategori filter dari URL
$kategori_filter = isset($_GET['kategori']) ? $_GET['kategori'] : "";

// Query sesuai filter
if ($kategori_filter) {
    $sql = "SELECT * FROM produk WHERE kategori = '$kategori_filter'";
} else {
    $sql = "SELECT * FROM produk";
}

$result = mysqli_query($conn, $sql);

// Ambil daftar kategori unik untuk dropdown filter
$kategori_result = mysqli_query($conn, "SELECT DISTINCT kategori FROM produk");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <style>
        .produk { border: 1px solid #ccc; padding: 10px; margin: 10px; }
        select { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Daftar Produk</h1>

    <!-- Filter berdasarkan kategori -->
    <form method="GET" action="">
        <label for="kategori">Filter Kategori:</label>
        <select name="kategori" id="kategori" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            <?php while ($row = mysqli_fetch_assoc($kategori_result)) { ?>
                <option value="<?php echo $row['kategori']; ?>" <?php if($kategori_filter==$row['kategori']) echo "selected"; ?>>
                    <?php echo $row['kategori']; ?>
                </option>
            <?php } ?>
        </select>
        <a href="tambah_produk.html"><button type="button">Tambah Data</button></a>
    </form>

    <!-- Tampilkan Produk -->
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="produk">';
            echo '<h3>' . $row['nama'] . '</h3>';
            echo '<p>Harga: Rp ' . number_format($row['harga'], 0, ',', '.') . '</p>';
            echo '<p>' . $row['deskripsi'] . '</p>';
            echo '<p><strong>Kategori:</strong> ' . $row['kategori'] . '</p>';
            echo '</div>';
        }
    } else {
        echo "<p>Produk tidak ditemukan.</p>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>
