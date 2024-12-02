<?php

include 'config.php';

// Ambil data dari tabel pengaduan
$query = "SELECT * FROM pengaduan";
$result = $conn->query($query);

// Periksa apakah hasil query memiliki data
if ($result->num_rows > 0) {
    $no = 1; // Inisialisasi nomor urut
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . htmlspecialchars($row['nik']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
        echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tempat_lahir']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tanggal_lahir']) . "</td>";
        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pengaduan']) . "</td>";
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
        
        echo "<td>";
        echo "<a href='selesai.php?id=" . $row['id'] . "' class='btn-konfirmasi' onclick=\"return confirm('Apakah Anda yakin ingin mengonfirmasi selesai?')\">Selesai</a> ";
        echo "<a href='delete.php?id=" . $row['id'] . "' class='btn-hapus' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?\')\">Hapus</a>";
        echo "</td>";

        echo "</tr>";
    }
} else {
    // Jika tidak ada data, tampilkan pesan dalam satu baris
    echo "<tr><td colspan='10'>Tidak ada pengaduan.</td></tr>";
}
?>
