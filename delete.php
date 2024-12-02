<?php
include 'config.php'; // Pastikan file konfigurasi untuk koneksi database sudah benar

// Periksa apakah parameter ID dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validasi bahwa ID adalah angka
    if (is_numeric($id)) {
        // Query untuk menghapus data dari tabel pengajuan
        $query = "DELETE FROM pengajuan WHERE id = ?";

        // Siapkan statement
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $id); // Mengikat parameter ID

            // Eksekusi query
            if ($stmt->execute()) {
                // Berhasil menghapus
                echo "<script>
                    alert('Data berhasil dihapus!');
                    window.location.href = 'dashboardadmin.html'; // Redirect ke halaman admin
                </script>";
            } else {
                // Gagal menghapus
                echo "<script>
                    alert('Gagal menghapus data: " . htmlspecialchars($stmt->error) . "');
                    window.history.back();
                </script>";
            }

            $stmt->close(); // Tutup statement
        } else {
            // Kesalahan pada prepare statement
            echo "<script>
                alert('Kesalahan pada query: " . htmlspecialchars($conn->error) . "');
                window.history.back();
            </script>";
        }
    } else {
        // Jika ID bukan angka
        echo "<script>
            alert('ID tidak valid.');
            window.history.back();
        </script>";
    }
} else {
    // Jika parameter ID tidak ditemukan
    echo "<script>
        alert('Parameter ID tidak ditemukan.');
        window.history.back();
    </script>";
}

$conn->close(); // Tutup koneksi database
?>



<?php
include 'config.php'; // Pastikan file konfigurasi untuk koneksi database sudah benar

// Periksa apakah parameter ID dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validasi bahwa ID adalah angka
    if (is_numeric($id)) {
        // Query untuk menghapus data dari tabel pengajuan
        $query = "DELETE FROM pengaduan WHERE id = ?";

        // Siapkan statement
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $id); // Mengikat parameter ID

            // Eksekusi query
            if ($stmt->execute()) {
                // Berhasil menghapus
                echo "<script>
                    alert('Data berhasil dihapus!');
                    window.location.href = 'dashboardadmin.html'; // Redirect ke halaman admin
                </script>";
            } else {
                // Gagal menghapus
                echo "<script>
                    alert('Gagal menghapus data: " . htmlspecialchars($stmt->error) . "');
                    window.history.back();
                </script>";
            }

            $stmt->close(); // Tutup statement
        } else {
            // Kesalahan pada prepare statement
            echo "<script>
                alert('Kesalahan pada query: " . htmlspecialchars($conn->error) . "');
                window.history.back();
            </script>";
        }
    } else {
        // Jika ID bukan angka
        echo "<script>
            alert('ID tidak valid.');
            window.history.back();
        </script>";
    }
} else {
    // Jika parameter ID tidak ditemukan
    echo "<script>
        alert('Parameter ID tidak ditemukan.');
        window.history.back();
    </script>";
}

$conn->close(); // Tutup koneksi database
?>
