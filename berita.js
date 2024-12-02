// Muat data tabel untuk Menu 3
function loadBerita() {
    fetch('fetch_berita.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('beritaTable').innerHTML = data;
        });
}

// Simpan berita (Tambah/Edit)
document.getElementById('formBerita').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('save_berita.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(result => {
            alert(result);
            this.reset();
            loadBerita();
        });
});

// Hapus berita
function deleteBerita(id) {
    if (confirm('Yakin ingin menghapus berita ini?')) {
        fetch(`delete_berita.php?id=${id}`)
            .then(response => response.text())
            .then(result => {
                alert(result);
                loadBerita();
            });
    }
}

// Edit berita
function editBerita(id) {
    fetch(`get_berita.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('beritaId').value = data.id;
            document.getElementById('judul').value = data.judul;
            document.getElementById('isi').value = data.isi;
        });
}

// Tampilkan menu pertama saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    loadBerita();
});
