@extends('layouts.app')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna | Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen relative">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 bg-white fixed inset-y-0 left-0 border-r z-40
               transition-all duration-300 flex flex-col">

        <div class="p-6 text-xl font-bold text-indigo-700 border-b">
            Perpustakaan Digital
        </div>

        <nav class="mt-6 space-y-1 px-4 text-sm text-slate-600">

            <!-- Dashboard -->
            <a href="{{ route('dashboard.user') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-xl
                      bg-indigo-50 text-indigo-700 font-semibold hover:bg-indigo-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 3h7v7H3V3zm11 0h7v11h-7V3zM3 13h7v8H3v-8z"/>
                </svg>
                Dashboard
            </a>

            <!-- Koleksi Buku (ICON BUKU) -->
            <a href="{{ route('books.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6a2 2 0 012-2h12v16H6a2 2 0 01-2-2V6z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 4v16"/>
                </svg>
                Koleksi Buku
            </a>

            <!-- KOLEKSI SAYA / KOLEKSI PRIBADI -->
<a href="{{ route('koleksi.index') }}"
   class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-gray-100 transition">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 7a2 2 0 012-2h3l2 2h9a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
    </svg>
    Koleksi Saya
</a>


            <!-- Ulasan -->
            <a href="{{ route('reviews.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-gray-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8 10h8m-8 4h5M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.2-3.6A7.63 7.63 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            Ulasan Saya
        </a>

            <!-- Peminjaman -->
            <a href="{{ route('peminjaman.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                </svg>
                Peminjaman
            </a>

            <!-- Logout -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
@csrf

<button
type="button"
onclick="confirmLogout()"
class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-100 text-red-600 w-full text-left transition">

<svg xmlns="http://www.w3.org/2000/svg"
     class="w-5 h-5"
     fill="none"
     viewBox="0 0 24 24"
     stroke="currentColor"
     stroke-width="1.8">

<path stroke-linecap="round"
      stroke-linejoin="round"
      d="M17 16l4-4m0 0l-4-4m4 4H7M7 4v16"/>

</svg>

Logout

</button>
            </form>

        </nav>

        <!-- KEMBALI KE BERANDA (MENYATU SIDEBAR) -->
        <div class="mt-auto px-4 pb-6 text-sm text-slate-600">
            <a href="{{ route('landing') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-xl hover:bg-gray-100 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
        </div>

    </aside>

    <!-- TOGGLE BUTTON -->
    <button onclick="toggleSidebar()"
        id="toggleBtn"
        class="fixed top-1/2 left-64 -translate-y-1/2 z-50
               bg-white border shadow rounded-full p-2
               hover:bg-gray-100 transition">

        <svg id="arrowIcon" class="w-5 h-5 text-slate-700"
            fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 19l-7-7 7-7"/>
        </svg>
    </button>

    <!-- MAIN CONTENT -->
    <main id="mainContent" class="flex-1 ml-64 transition-all duration-300">
        <div class="pt-20 pb-20">
            <div class="max-w-7xl mx-auto px-10">

                <h1 class="text-3xl font-extrabold text-slate-800 mb-2">
                    Halo, {{ auth()->user()->name }}
                </h1>
                <p class="text-slate-500 mb-10">
                    Selamat datang kembali di perpustakaan digital
                </p>

                <div class="grid md:grid-cols-3 gap-6 mb-14">

                    <div class="bg-white border rounded-2xl shadow-sm p-6">
                        <p class="text-sm text-slate-500">Buku Tersedia</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $totalBuku }}</h3>
                    </div>

                    <div class="bg-white border rounded-2xl shadow-sm p-6">
                        <p class="text-sm text-slate-500">Ulasan Saya</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $totalUlasan }}</h3>
                    </div>

                    <div class="bg-white border rounded-2xl shadow-sm p-6">
                        <p class="text-sm text-slate-500">Buku Dipinjam</p>
                        <h3 class="text-3xl font-bold mt-2">{{ $totalDipinjam }}</h3>
                    </div>

                </div>

            </div>
        </div>
    </main>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('mainContent');
    const btn = document.getElementById('toggleBtn');
    const arrow = document.getElementById('arrowIcon');

    if (sidebar.classList.contains('-ml-64')) {
        sidebar.classList.remove('-ml-64');
        main.classList.remove('ml-0');
        main.classList.add('ml-64');
        btn.classList.remove('left-4');
        btn.classList.add('left-64');
        arrow.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>';
    } else {
        sidebar.classList.add('-ml-64');
        main.classList.remove('ml-64');
        main.classList.add('ml-0');
        btn.classList.remove('left-64');
        btn.classList.add('left-4');
        arrow.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>';
    }
}
</script>

</body>
</html>
