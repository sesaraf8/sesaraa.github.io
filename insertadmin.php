<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'desa_candiwulan');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Password admin baru
$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT); // Hash password

// Simpan ke database
$sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username, $password);

if ($stmt->execute()) {
    echo "Admin berhasil ditambahkan.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
