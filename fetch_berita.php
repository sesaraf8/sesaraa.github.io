<?php

// Sertakan file konfigurasi database
include 'config.php'; // Pastikan rute ini benar, misalnya "../config.php" jika berada di folder berbeda.

try {
    // Ambil semua data berita dari database
    $stmt = $pdo->prepare("SELECT * FROM berita ORDER BY id DESC LIMIT 3");
    $stmt->execute();
    $berita = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($berita) {
        foreach ($berita as $item) {
            echo '<div class="kotak-berita">';
            echo '<div class="gambar" style="background-image: url(\'uploadsberita/' . htmlspecialchars($item['gambar']) . '\');"></div>';
            echo '<div class="text">';
            echo '<h4>' . htmlspecialchars($item['judul']) . '</h4>';
            echo '<p>' . htmlspecialchars(substr($item['isi'], 0, 150)) . '...</p>';
            echo '<a href="detail.php?id=' . htmlspecialchars($item['id']) . '">Baca Selengkapnya</a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>Tidak ada berita untuk ditampilkan.</p>";
    }
} catch (PDOException $e) {
    echo "<p>Kesalahan database: " . $e->getMessage() . "</p>";
}
?>
