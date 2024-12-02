<?php

include 'config.php'; // Menyertakan file konfigurasi

// Aktifkan laporan error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dengan validasi awal
    $nik = trim($_POST['nik']);
    $nama = trim($_POST['nama']);
    $jenis_kelamin = trim($_POST['jenis_kelamin']);
    // Validasi untuk memastikan jenis kelamin dipilih
    if (!empty($jenis_kelamin)) {
        echo "Jenis Kelamin yang dipilih: " . htmlspecialchars($jenis_kelamin);
    } else {
        echo "Jenis Kelamin belum dipilih!";
    }
    $tempat_lahir = trim($_POST['tempat_lahir']);
    $tanggal_lahir = trim($_POST['tanggal_lahir']);
    $alamat = trim($_POST['alamat']);
    $pengaduan = trim($_POST['pengaduan']);

    // Validasi input
    if (empty($nik) || empty($nama) || empty($jenis_kelamin) || empty($tempat_lahir) || 
        empty($tanggal_lahir) || empty($alamat) || empty($pengaduan)) {
        echo '<script>
            alert("Semua field harus diisi.");
            window.history.back();
        </script>';
        exit();
    }

    // Gunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO pengaduan (nik, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, pengaduan) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        // Bind parameter
        $stmt->bind_param("sssssss", $nik, $nama, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $alamat, $pengaduan);

        // Eksekusi query
        if ($stmt->execute()) {
            echo '<script>
                alert("Data berhasil disimpan!");
                window.location.href = "index.php";
            </script>';
        } else {
            echo '<script>
                alert("Terjadi kesalahan saat menyimpan data: ' . htmlspecialchars($stmt->error) . '");
                window.history.back();
            </script>';
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo '<script>
            alert("Kesalahan pada query: ' . htmlspecialchars($conn->error) . '");
            window.history.back();
        </script>';
    }

    // Tutup koneksi database
    $conn->close();
} else {
    echo '<script>
        alert("Metode pengiriman tidak valid.");
        window.history.back();
    </script>';
}
?>
