<?php
// Mulai session
session_start();

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'desa_candiwulan'); // Sesuaikan nama database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari admin berdasarkan username
$sql = "SELECT * FROM admin WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

// Periksa apakah username ditemukan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();



    // Verifikasi password
    if (password_verify($password, $row['password'])) {
        echo "Password cocok!<br>";
        // Simpan session dan redirect
        $_SESSION['username'] = $username;
        header("Location: dashboardadmin.html");
        exit();
    } else {
        echo "Password tidak cocok!<br>";
    }
} else {
    echo "Username tidak ditemukan!<br>";
}

$stmt->close();
$conn->close();
?>
