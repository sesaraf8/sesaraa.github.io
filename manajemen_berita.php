<?php
// Konfigurasi koneksi ke database
$host = 'localhost';
$dbname = 'desa_candiwulan';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

// Fungsi untuk menangani upload gambar
function uploadImage($file) {
    $targetDir = "uploadsberita/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Membuat folder jika belum ada
    }

    $fileName = time() . '_' . basename($file['name']);
    $targetFile = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validasi file gambar
    if (!getimagesize($file['tmp_name'])) {
        return false; // Bukan file gambar
    }
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        return false; // Format file tidak valid
    }
    if ($file['size'] > 500000) {
        return false; // File terlalu besar
    }

    // Pindahkan file ke folder tujuan
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return $fileName;
    } else {
        return false;
    }
}

// Tangani permintaan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null; // ID untuk update atau delete
    $judul = $_POST['judul'] ?? '';
    $isi = $_POST['isi'] ?? '';
    $action = $_POST['action'] ?? ''; // Action: add, update, delete
    $gambar = null;

    // Periksa jika ada file gambar yang diupload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $gambar = uploadImage($_FILES['gambar']);
        if (!$gambar) {
            die("Gagal mengunggah gambar.");
        }
    }

    try {
        if ($action === 'add') {
            // Tambahkan berita baru
            $stmt = $pdo->prepare("INSERT INTO berita (judul, isi, gambar) VALUES (?, ?, ?)");
            $stmt->execute([$judul, $isi, $gambar]);
            echo '<script>
                    alert("berita berhasil disimpan!");
                    window.location.href = "dashboardadmin.html";
                </script>';
        } elseif ($action === 'update' && $id) {
            // Perbarui berita yang ada
            if ($gambar) {
                // Jika gambar baru di-upload
                $stmt = $pdo->prepare("UPDATE berita SET judul = ?, isi = ?, gambar = ? WHERE id = ?");
                $stmt->execute([$judul, $isi, $gambar, $id]);
            } else {
                // Jika gambar tidak diubah
                $stmt = $pdo->prepare("UPDATE berita SET judul = ?, isi = ? WHERE id = ?");
                $stmt->execute([$judul, $isi, $id]);
            }
            echo '<script>
                    alert("berita berhasil diperbarui!");
                    window.location.href = "dashboardadmin.html";
                </script>';
        } elseif ($action === 'delete' && $id) {
            // Hapus berita berdasarkan ID
            $stmt = $pdo->prepare("DELETE FROM berita WHERE id = ?");
            $stmt->execute([$id]);
            echo '<script>
                    alert("berita berhasil dihapus!");
                    window.location.href = "dashboardadmin.html";
                </script>';
        } else {
            echo '<script>
                    alert("tidak valid!");
                    window.location.href = "dashboardadmin.html";
                </script>';
        }
    } catch (PDOException $e) {
        echo "Kesalahan database: " . $e->getMessage();
    }
}
?>
