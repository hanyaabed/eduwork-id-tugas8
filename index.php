<?php
include 'koneksi.php';

// Ambil kategori filter dari URL (GET)
$kategori_filter = isset($_GET['kategori']) ? $_GET['kategori'] : "";

// Query produk sesuai filter
if ($kategori_filter) {
    $sql = "SELECT * FROM produk WHERE kategori = '$kategori_filter'";
} else {
    $sql = "SELECT * FROM produk";
}
$result = mysqli_query($conn, $sql);

// Ambil daftar kategori unik
$kategori_result = mysqli_query($conn, "SELECT DISTINCT kategori FROM produk");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Commerce</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Daftar Produk</h1>

         <!-- Filter kategori -->
        <form method="GET" class="mb-4 text-center">
            <label for="kategori" class="form-label fw-bold">Filter Kategori:</label>
            <select name="kategori" id="kategori" class="form-select w-25 d-inline" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <?php while ($row = mysqli_fetch_assoc($kategori_result)) { ?>
                    <option value="<?php echo $row['kategori']; ?>" 
                        <?php if ($kategori_filter == $row['kategori']) echo "selected"; ?>>
                        <?php echo $row['kategori']; ?>
                    </option>
                <?php } ?>
            </select>
        </form>
        
        <!-- Produk -->
        <div class="row">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['nama']; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></h6>
                                <p class="card-text"><?php echo $row['deskripsi']; ?></p>
                                <span class="badge bg-primary"><?php echo $row['kategori']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>Belum ada produk.</p>";
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
