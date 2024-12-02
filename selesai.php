<?php
include 'config.php'; // Menghubungkan ke database

// Periksa apakah parameter ID tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Ambil ID dari parameter URL

    // Validasi bahwa ID adalah angka
    if (is_numeric($id)) {
        // Query untuk memperbarui status
        $query = "UPDATE pengajuan SET status = 'Selesai' WHERE id = ?";

        // Siapkan statement
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $id);

            // Eksekusi statement
            if ($stmt->execute()) {
                // Berhasil memperbarui
                echo "<script>
                    alert('Status berhasil diperbarui menjadi Selesai.');
                    window.location.href = 'dashboardadmin.html'; // Kembali ke halaman admin
                </script>";
            } else {
                // Gagal memperbarui
                echo "<script>
                    alert('Gagal memperbarui status: " . htmlspecialchars($stmt->error) . "');
                    window.history.back();
                </script>";
            }
            $stmt->close();
        } else {
            // Kesalahan pada prepare statement
            echo "<script>
                alert('Kesalahan pada query.');
                window.history.back();
            </script>";
        }
    } else {
        // ID bukan angka
        echo "<script>
            alert('ID tidak valid.');
            window.history.back();
        </script>";
    }
} else {
    // Parameter ID tidak ditemukan
    echo "<script>
        alert('Parameter ID tidak ditemukan.');
        window.history.back();
    </script>";
}

$conn->close(); // Tutup koneksi database
?>


<?php
include 'config.php'; // Menghubungkan ke database

// Periksa apakah parameter ID tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Ambil ID dari parameter URL

    // Validasi bahwa ID adalah angka
    if (is_numeric($id)) {
        // Query untuk memperbarui status
        $query = "UPDATE pengaduan SET status = 'Selesai' WHERE id = ?";

        // Siapkan statement
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("i", $id);

            // Eksekusi statement
            if ($stmt->execute()) {
                // Berhasil memperbarui
                echo "<script>
                    alert('Status berhasil diperbarui menjadi Selesai.');
                    window.location.href = 'dashboardadmin.html'; // Kembali ke halaman admin
                </script>";
            } else {
                // Gagal memperbarui
                echo "<script>
                    alert('Gagal memperbarui status: " . htmlspecialchars($stmt->error) . "');
                    window.history.back();
                </script>";
            }
            $stmt->close();
        } else {
            // Kesalahan pada prepare statement
            echo "<script>
                alert('Kesalahan pada query.');
                window.history.back();
            </script>";
        }
    } else {
        // ID bukan angka
        echo "<script>
            alert('ID tidak valid.');
            window.history.back();
        </script>";
    }
} else {
    // Parameter ID tidak ditemukan
    echo "<script>
        alert('Parameter ID tidak ditemukan.');
        window.history.back();
    </script>";
}

$conn->close(); // Tutup koneksi database
?>
