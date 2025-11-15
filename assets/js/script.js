// ============================================== */
// === MAIN JS FILE FOR PUSDIK DIGITAL LIBRARY 
// ============================================== */

document.addEventListener('DOMContentLoaded', function() {

    // ================================================= */
    // === 01. LOGIN / REGISTER FORM VALIDATION (CLIENT SIDE)
    // ================================================= */

    const authForm = document.querySelector('.auth-box form');
    if (authForm) {
        authForm.addEventListener('submit', function(e) {
            // Contoh validasi sisi klien sederhana untuk menghindari submit kosong
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (email.trim() === '' || password.trim() === '') {
                alert('Email dan Password wajib diisi.');
                e.preventDefault();
                return;
            }

            // Untuk form Registrasi, cek konfirmasi password
            const passconf = document.getElementById('passconf');
            if (passconf) {
                if (password !== passconf.value) {
                    alert('Konfirmasi Password tidak cocok.');
                    e.preventDefault();
                    return;
                }
            }
            // Validasi sisi server (CodeIgniter Form Validation) akan menangani sisanya.
        });
    }

    // ================================================= */
    // === 02. ADMIN CONFIRMATION FOR DANGEROUS ACTIONS (DELETE/DEACTIVATE)
    // ================================================= */
    
    // Cari semua elemen dengan class 'confirm-action'
    const confirmActions = document.querySelectorAll('.confirm-action');

    confirmActions.forEach(link => {
        link.addEventListener('click', function(e) {
            // Ambil teks konfirmasi dari data-text attribute
            const confirmationText = this.getAttribute('data-text');

            // Tampilkan dialog konfirmasi
            if (!confirm(`Apakah Anda yakin ingin ${confirmationText}`)) {
                e.preventDefault(); // Batalkan aksi jika pengguna menekan 'Cancel'
            }
        });
    });

    // ================================================= */
    // === 03. GENERAL UI ENHANCEMENTS (Sidebar/Menu Toggle)
    // ================================================= */

    // Fitur ini akan berguna jika Anda menggunakan framework CSS dengan toggle sidebar,
    // namun kita biarkan kosong dulu. Jika Anda menambahkan tombol toggle sidebar di admin.css,
    // kode toggle akan diletakkan di sini.

    // Contoh: Log sederhana untuk memastikan file dimuat
    console.log('Script.js berhasil dimuat. DOM content loaded.');

});