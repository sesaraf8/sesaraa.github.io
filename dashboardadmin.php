<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: loginadmin.php");
    exit();
}

include 'config.php';

$query = "SELECT * FROM pengajuan";
$result = $conn->query($query);

$query = "SELECT * FROM pengajuan2";
$result = $conn->query($query);




include 'config.php'; // Pastikan file ini berisi koneksi ke database Anda

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil input dari form
    $judul = trim($_POST['judul']);
    $isi = trim($_POST['isi']);

    // Menangani upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploadsberita/"; // Folder untuk menyimpan gambar
        $target_file = $target_dir . basename($gambar);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file gambar
        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Hanya gambar dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan.";
            exit;
        }

        // Cek apakah file berhasil di-upload
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Menggunakan prepared statements untuk menghindari SQL Injection
            $stmt = $conn->prepare("INSERT INTO berita (judul, isi, gambar) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $judul, $isi, $gambar);

            // Eksekusi query untuk insert data berita
            if ($stmt->execute()) {
                echo "Berita berhasil ditambahkan.";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Menutup prepared statement
            $stmt->close();
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}
?>

