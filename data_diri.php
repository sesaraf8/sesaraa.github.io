<?php
include 'config.php'; // Menyertakan file konfigurasi di awal



// Aktifkan laporan error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Periksa apakah form telah dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST')
 {
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
    $agama = trim($_POST['agama']);
    $pekerjaan = trim($_POST['pekerjaan']);
    $alamat = trim($_POST['alamat']);
    $jenis_surat = trim($_POST['jenis_surat']);

    // Validasi input
    if (empty($nik) || empty($nama) || empty($jenis_kelamin) || empty($tempat_lahir) || empty($tanggal_lahir) || 
        empty($agama) || empty($pekerjaan) || empty($alamat) || empty($jenis_surat)) {
        echo '<script>
            alert("Semua field harus diisi.");
            window.history.back();
        </script>';
        exit();
    }

    // Upload file KTP
    $file_ktp = $_FILES['file_ktp']['name'] ?? null;
    $file_ktp_tmp = $_FILES['file_ktp']['tmp_name'] ?? null;

    // Upload file KK
    $file_kk = $_FILES['file_kk']['name'] ?? null;
    $file_kk_tmp = $_FILES['file_kk']['tmp_name'] ?? null;

    // Validasi file upload
    if (empty($file_ktp) || empty($file_kk)) {
        echo '<script>
            alert("File KTP dan KK harus diunggah.");
            window.history.back();
        </script>';
        exit();
    }

    // Validasi tipe file dan ukuran
    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
    $max_file_size = 2 * 1024 * 1024; // 2MB

    // Ambil ekstensi file
    $file_ktp_extension = strtolower(pathinfo($file_ktp, PATHINFO_EXTENSION));
    $file_kk_extension = strtolower(pathinfo($file_kk, PATHINFO_EXTENSION));

    // Validasi file KTP
    if (!in_array(mime_content_type($file_ktp_tmp), $allowed_types)) {
        echo '<script>
            alert("Tipe MIME file KTP tidak valid.");
            window.history.back();
        </script>';
        exit();
    }
    if ($_FILES['file_ktp']['size'] > $max_file_size) {
        echo '<script>
            alert("Ukuran file KTP terlalu besar. Maksimum 2MB.");
            window.history.back();
        </script>';
        exit();
    }
    
    // Validasi file KK
    if (!in_array($file_kk_extension, $allowed_extensions)) {
        echo '<script>
            alert("File KK tidak valid. Ekstensi diperbolehkan: jpg, jpeg, png, pdf.");
            window.history.back();
        </script>';
        exit();
    }
    if (!in_array(mime_content_type($file_kk_tmp), $allowed_types)) {
        echo '<script>
            alert("Tipe MIME file KK tidak valid.");
            window.history.back();
        </script>';
        exit();
    }
    if ($_FILES['file_kk']['size'] > $max_file_size) {
        echo '<script>
            alert("Ukuran file KK terlalu besar. Maksimum 2MB.");
            window.history.back();
        </script>';
        exit();
    }

    // Cek apakah folder uploads ada, jika tidak, buat folder
    if (!is_dir('uploads')) {
        if (!mkdir('uploads', 0755, true)) {
            echo '<script>
                alert("Gagal membuat folder uploads.");
                window.history.back();
            </script>';
            exit();
        }
    }

    // Berikan nama baru yang unik untuk file
    $file_ktp_new = uniqid('ktp_', true) . '.' . $file_ktp_extension;
    $file_kk_new = uniqid('kk_', true) . '.' . $file_kk_extension;

    // Buat jalur file baru
    $file_ktp_path = 'uploads/' . $file_ktp_new;
    $file_kk_path = 'uploads/' . $file_kk_new;

    // Pindahkan file ke folder uploads
    $upload_ktp = move_uploaded_file($file_ktp_tmp, $file_ktp_path);
    $upload_kk = move_uploaded_file($file_kk_tmp, $file_kk_path);

    if ($upload_ktp && $upload_kk) {
        // Simpan data ke database menggunakan prepared statement
        $stmt = $conn->prepare("INSERT INTO pengajuan (nik, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, pekerjaan, alamat, jenis_surat, file_ktp, file_kk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssssssssss", $nik, $nama, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $agama, $pekerjaan, $alamat, $jenis_surat, $file_ktp_new, $file_kk_new);

            if ($stmt->execute()) {
                echo '<script>
                    alert("pengajuan berhasil disimpan!");
                    window.location.href = "index.php";
                </script>';
            } else {
                echo '<script>
                    alert("Terjadi kesalahan saat menyimpan data: ' . htmlspecialchars($stmt->error) . '");
                    window.history.back();
                </script>';
            }

            $stmt->close();
        } else {
            echo '<script>
                alert("Kesalahan pada query: ' . htmlspecialchars($conn->error) . '");
                window.history.back();
            </script>';
        }
    } else {
        echo '<script>
            alert("Gagal mengupload file. Pastikan file tidak rusak.");
            window.history.back();
        </script>';
    }
} else {
    echo '<script>
        alert("Metode pengiriman tidak valid.");
        window.history.back();
    </script>';
}

// Tutup koneksi
$conn->close();
?>


