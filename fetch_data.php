<?php
include 'config.php';

// Ambil data dari tabel pengajuan
$query = "SELECT * FROM pengajuan";
$result = $conn->query($query);


if ($result->num_rows > 0) {
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . htmlspecialchars($row['nik']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
        echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tempat_lahir']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tanggal_lahir']) . "</td>";
        echo "<td>" . htmlspecialchars($row['agama']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pekerjaan']) . "</td>";
        echo "<td>" . htmlspecialchars($row['alamat']) . "</td>";
        echo "<td>" . htmlspecialchars($row['jenis_surat']) . "</td>";

        // Tampilkan link untuk file KTP
        if (!empty($row['file_ktp'])) {
            echo "<td><a href='uploads/" . htmlspecialchars($row['file_ktp']) . "' target='_blank'>Lihat KTP</a></td>";
            
        } else {
            echo "<td>Tidak ada file</td>";
        }

        // Tampilkan link untuk file KK
        if (!empty($row['file_kk'])) {
            echo "<td><a href='uploads/" . htmlspecialchars($row['file_kk']) . "' target='_blank'>Lihat KK</a></td>";
        } else {
            echo "<td>Tidak ada file</td>";
        }

        echo "<td>";
        echo "<a href='selesai.php?id=" . $row['id'] . "' class='btn-konfirmasi' onclick=\"return confirm('Apakah Anda yakin ingin mengonfirmasi selesai?')\">Selesai</a> ";
        echo "<a href='delete.php?id=" . $row['id'] . "' class='btn-hapus' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?\')\">Hapus</a>";
        echo "</td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='12'>Tidak ada data yang tersedia.</td></tr>";
}

?>