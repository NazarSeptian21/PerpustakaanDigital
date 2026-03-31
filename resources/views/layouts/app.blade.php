<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Perpustakaan Digital')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('styles')
</head>

<body class="bg-gray-100 min-h-screen">

<main class="w-full">
    @yield('content')
</main>

@stack('scripts')

{{-- ================= GLOBAL SWEETALERT ================= --}}
<script>

document.addEventListener("DOMContentLoaded", function(){

    /* =========================
       ALERT SUCCESS
    ========================= */
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#16a34a'
    })
    @endif

    /* =========================
       ALERT ERROR
    ========================= */
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: '{{ session('error') }}',
        confirmButtonColor: '#dc2626'
    })
    @endif

/* =========================
       ALERT WARNING
    ========================= */
    @if(session('warning'))
    Swal.fire({
        icon: 'warning',
        title: 'Peringatan',
        text: '{{ session('warning') }}',
        confirmButtonColor: '#f59e0b'
    })
    @endif

    /* =========================
       ALERT INFO (POPUP GLOBAL BARU)
    ========================= */
    @if(session('info'))
    Swal.fire({
        icon: 'info',
        title: 'Informasi',
        text: '{{ session('info') }}',
        confirmButtonColor: '#3b82f6'
    })
    @endif


    /* =========================
       KONFIRMASI HAPUS GLOBAL
    ========================= */
    const deleteButtons = document.querySelectorAll('.btn-hapus');

    deleteButtons.forEach(function(button){

        button.addEventListener('click', function(e){

            e.preventDefault();

            const form = this.closest("form");

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });

    });

});

    // ================= FUNGSI POPUP GLOBAL BARU =================
    /**
     * Fungsi global untuk tampilkan SweetAlert popup dari mana saja
     * @param {string} type - 'success|error|warning|info|question'
     * @param {string} title
     * @param {string} text
     * @param {object} options - optional config
     */
    window.showGlobalPopup = function(type = 'info', title = 'Info', text = '', options = {}) {
        const config = {
            icon: type,
            title: title,
            text: text,
            confirmButtonColor: '#3b82f6',
            ...options
        };

        Swal.fire(config);
    };


/* =========================
   KONFIRMASI LOGOUT
========================= */
function confirmLogout(){

Swal.fire({
title: 'Keluar dari akun?',
text: "Kamu akan logout dari sistem",
icon: 'question',
showCancelButton: true,
confirmButtonColor: '#2563eb',
cancelButtonColor: '#6b7280',
confirmButtonText: 'Ya, Logout',
cancelButtonText: 'Batal'

}).then((result) => {

if (result.isConfirmed) {
document.getElementById('logout-form').submit();
}

});

}

</script>
{{-- ===================================================== --}}

</body>
</html>
