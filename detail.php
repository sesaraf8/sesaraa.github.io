<?php
// Sertakan file konfigurasi database
include 'config.php'; // Ubah sesuai lokasi file konfigurasi Anda

try {
    // Periksa apakah parameter `id` ada di URL dan valid
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = intval($_GET['id']); // Pastikan ID adalah angka

        // Query untuk mendapatkan data berita berdasarkan ID
        $stmt = $pdo->prepare("SELECT * FROM berita WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            // Jika berita ditemukan, tampilkan detailnya
            ?>
            <!DOCTYPE html>
            <html lang="id">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php echo htmlspecialchars($item['judul']); ?></title>
                <link rel="stylesheet" href="detail.css">
            </head>
            <body>
                <div class="container">
                    <h1><?php echo htmlspecialchars($item['judul']); ?></h1>
                    <div class="gambar" style="background-image: url('uploadsberita/<?php echo htmlspecialchars($item['gambar']); ?>');"></div>
                    <p><?php echo nl2br(htmlspecialchars($item['isi'])); ?></p>
                    <a href="index.php">Kembali ke Beranda</a>
                </div>
            </body>
            </html>
            <?php
        } else {
            // Jika berita tidak ditemukan
            echo "<p>Berita tidak ditemukan.</p>";
        }
    } else {
        // Jika ID tidak valid atau tidak diberikan
        echo "<p>ID berita tidak valid.</p>";
    }
} catch (PDOException $e) {
    // Tangani kesalahan database
    echo "<p>Kesalahan database: " . $e->getMessage() . "</p>";
}
?>
