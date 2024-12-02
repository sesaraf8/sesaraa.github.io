<?php
$servername = "localhost";
$username = "root";
$password = ""; // Ganti dengan password database Anda
$dbname = "desa_candiwulan"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>


<?php
$host = "localhost";
$dbname = "desa_candiwulan";
$username = "root"; // Ganti sesuai username MySQL
$password = ""; // Ganti sesuai password MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
