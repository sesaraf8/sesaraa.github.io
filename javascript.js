// Seleksi elemen tombol-menu dan menu
var tombolMenu = $(".tombol-menu");
var menu = $("nav .menu ul");

// Fungsi untuk menampilkan atau menyembunyikan menu saat tombol-menu diklik
tombolMenu.on("click", function () {
    menu.toggle(); // Toggle visibilitas menu
    tombolMenu.toggleClass("active"); // Tambahkan/kurangi kelas "active" untuk animasi burger
});

// Atur visibilitas menu berdasarkan ukuran layar
$(window).on("resize", function () {
    var width = $(window).width();
    if (width > 989) {
        menu.css("display", "flex"); // Tampilkan menu pada layar besar
    } else {
        menu.css("display", "none"); // Sembunyikan menu pada layar kecil
    }
});


// Menambahkan event listener untuk scroll
window.addEventListener("scroll", function () {
    // Seleksi elemen navbar
    const navbar = document.querySelector("nav");
    
    // Jika posisi scroll melebihi 50px, tambahkan kelas 'putih'
    if (window.scrollY > 50) {
        navbar.classList.add("putih");
    } else {
        // Jika posisi scroll kembali ke atas, hapus kelas 'putih'
        navbar.classList.remove("putih");
    }
});


function showNotification(message, type = "success") {
    const notification = document.getElementById("notification");

    // Set pesan dan tipe notifikasi
    notification.textContent = message;
    notification.className = "notification"; // Reset kelas
    notification.classList.add(type); // Tambahkan kelas berdasarkan tipe

    // Tampilkan notifikasi
    notification.style.top = "20px";

    // Sembunyikan notifikasi setelah 3 detik
    setTimeout(() => {
        notification.style.top = "-100px";
    }, 3000);
}



