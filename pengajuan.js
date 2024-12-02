function setActive(itemId) {
    var selectedText = document.getElementById(itemId).textContent; // Ambil teks dari menu yang diklik
    document.getElementById('jenis_surat').value = selectedText;    // Set teks ke elemen hidden
}

document.addEventListener('DOMContentLoaded', function () {
    const sidebarLinks = document.querySelectorAll('.sidebar ul li a');
    
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah refresh halaman
            
            // Menghapus kelas 'active' dari semua link
            sidebarLinks.forEach(link => link.classList.remove('active'));
            
            // Menambahkan kelas 'active' pada link yang diklik
            this.classList.add('active');
        });
    });
});
