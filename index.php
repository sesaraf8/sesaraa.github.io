
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Candiwulan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="layer-dalam">
            <div class="logo">
                <a href="#"><img src="asset/img/pbg.png" class="putih" alt="Logo Desa Candiwulan"></a>
            </div>
            <div class="menu">
                <a href="#" class="tombol-menu">
                    <span class="garis"></span>
                    <span class="garis"></span>
                    <span class="garis"></span>
                </a>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#tentang">Tentang</a></li>
                    <li><a href="#layanan">Layanan</a></li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="admin.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="layarpenuh">
        <header id="home">
            <div class="overlay"></div>
            <video autoplay muted loop>
                <source src="asset/video/Droneview.mp4" type="video/mp4">
                Browser Anda tidak mendukung video tag.
            </video>
            <div class="intro">
                <h3>Desa Candiwulan</h3>
                <p>Website Pelayanan Masyarakat</p>
                <a href="myinfo.php" class="tombol">MORE INFO</a>
            </div>
        </header>

        <main>
            <!-- Tentang Section -->
            <section id="tentang">
                <div class="layar-dalam">
                    <h3>Tentang</h3>
                    <p class="ringkasan">Desa Candiwulan adalah pusat pelayanan masyarakat untuk berbagai kebutuhan administratif.</p>
                    <div class="konten-isi">
                        <p>Desa Candiwulan adalah sebuah desa yang terletak di kawasan yang subur dan indah, yang memiliki potensi besar dalam bidang pertanian, pariwisata, dan budaya. Desa ini menjadi salah satu tempat yang ramai dengan kegiatan masyarakat yang saling mendukung untuk membangun lingkungan yang nyaman dan sejahtera. Terletak di wilayah yang strategis, Candiwulan menjadi pusat kegiatan masyarakat sekitar, baik dalam bidang ekonomi, sosial, maupun budaya.Secara geografis, Desa Candiwulan dikelilingi oleh pegunungan yang hijau dan sungai yang mengalir jernih, memberikan keindahan alam yang luar biasa. Alam yang asri ini juga mendukung kegiatan pertanian, dengan mayoritas penduduknya yang menggantungkan hidup pada sektor pertanian seperti padi, jagung, dan hortikultura. Keberadaan alam yang mendukung ini menjadi salah satu daya tarik bagi para pengunjung yang ingin menikmati keindahan alam sekaligus belajar tentang pertanian tradisional yang masih diterapkan di desa ini..</p>
                    </div>
                </div>
            </section>

            <!-- Layanan Section -->
            <section class="abuabu" id="layanan">
                <div class="layar-dalam support">
                    <div>
                        <a href="pengajuan.html">
                            <img src="asset/img/logo pengajuan.png" alt="Pengajuan Surat">
                            <h6>Pengajuan Surat</h6>
                            <p>Ajukan surat dengan mudah melalui sistem online kami.</p>
                        </a>
                    </div>
                    <div>
                        <a href="pengajuan2.html">
                            <img src="asset/img/logo pengaduan.png" alt="Laporan Masyarakat">
                            <h6>Laporan Masyarakat</h6>
                            <p>Lakukan pelaporan kejadian secara cepat dan aman.</p>
                        </a>
                    </div>
                </div>
            </section>
            

            <!-- Berita Section -->
            <section id="berita">
                <h3>Berita Terkini</h3>
                <div class="kotak-berita-container">
                    <?php include 'fetch_berita.php'; // Pastikan jalur file benar ?>
                </div>
            </section>
            

            <!-- Quote Section -->
            <section class="quote">
                <div class="layar-dalam">
                    <p>Candiwulan Istimewa</p>
                </div>
            </section>

        <!-- Footer -->
        <footer id="contact">
            <div class="layar-dalam">
                <div>
                    <h5>Info</h5>
                    <p>Informasi umum tentang desa.</p>
                </div>
                <div>
                    <h5>Contact</h5>
                    <p>Hubungi kami untuk bantuan lebih lanjut.</p>
                </div>
                <div>
                    <h5>Help</h5>
                    <p>Pelayanan dan panduan teknis.</p>
                </div>
            </div>
            <div class="layar-dalam">
                <div class="copyright">
                    &copy; 2024 Desa Candiwulan. All Rights Reserved.
                </div>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="javascript.js"></script>
</body>
</html>
