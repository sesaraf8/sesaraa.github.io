<?php
// Mulai session
session_start();

// Cek apakah form login sudah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'desa_candiwulan');
    
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        echo "<script>alert('Username dan Password harus diisi!'); window.location.href='loginadmin.php';</script>";
        exit();
    }

    // Query untuk mencari admin berdasarkan username
    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah username ditemukan di database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifikasi password menggunakan password_verify
        if (password_verify($password, $row['password'])) {
            // Jika login berhasil, simpan username ke session
            $_SESSION['username'] = $row['username'];
            
            // Redirect ke halaman dashboard
            header("Location: dashboardadmin.php");
            exit();
        } else {
            // Jika password salah
            echo "<script>alert('Username atau Password salah!'); window.location.href='loginadmin.php';</script>";
        }
    } else {
        // Jika username tidak ditemukan
        echo "<script>alert('Username atau Password salah!'); window.location.href='loginadmin.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
