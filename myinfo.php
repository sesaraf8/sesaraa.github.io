<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengajuan</title>
    <link rel="stylesheet" href="myinfo.css"> <!-- CSS terpisah -->
</head>
<body>
    <div class="container">
        <h1>Info Pengajuan dan pengaduan</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

        
            <a href="index.php" class="back-home">Back Home</a>

                <?php
                    include 'config.php';

                    // Ambil data dari tabel pengajuan
                    $query1 = "SELECT id, nama, status FROM pengajuan";
                    $result1 = $conn->query($query1);

                    // Ambil data dari tabel pengajuan2
                    $query2 = "SELECT id, nama, status FROM pengaduan";
                    $result2 = $conn->query($query2);

                    // Gabungkan hasil
                    $no = 1; // Nomor urut
                    if ($result1 && $result1->num_rows > 0) {
                        while ($row = $result1->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                            $status = isset($row['status']) ? htmlspecialchars($row['status']) : 'Proses';
                            if ($status == 'Selesai') {
                                echo "<td><span class='status-selesai'>Selesai</span></td>";
                            } else {
                                echo "<td><span class='status-proses'>Proses</span></td>";
                            }
                            echo "</tr>";
                        }
                    }

                    if ($result2 && $result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                            $status = isset($row['status']) ? htmlspecialchars($row['status']) : 'Proses';
                            if ($status == 'Selesai') {
                                echo "<td><span class='status-selesai'>Selesai</span></td>";
                            } else {
                                echo "<td><span class='status-proses'>Proses</span></td>";
                            }
                            echo "</tr>";
                        }
                    }

                    // Jika tidak ada data sama sekali
                    if ((!$result1 || $result1->num_rows == 0) && (!$result2 || $result2->num_rows == 0)) {
                        echo "<tr><td colspan='3'>Tidak ada data yang tersedia.</td></tr>";
                    }
                ?>
            </tbody>
        </table>

    </div>
</body>
</html>
