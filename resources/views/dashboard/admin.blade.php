@extends('layouts.app')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

     nav::-webkit-scrollbar {
    width: 4px;
}

nav::-webkit-scrollbar-track {
    background: transparent;
}

nav::-webkit-scrollbar-thumb {
    background: #c7d2fe;
    border-radius: 10px;
}

nav::-webkit-scrollbar-thumb:hover {
    background: #818cf8;
}
    </style>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen relative">

<!-- SIDEBAR -->
<aside id="sidebar"
    class="w-64 bg-white fixed inset-y-0 left-0 border-r z-40
           transition-all duration-300 flex flex-col">

    <div class="p-6">
        <h2 class="text-xl font-bold text-indigo-600">
            Admin Panel
        </h2>
        <p class="text-xs text-gray-500">Perpustakaan Digital</p>
    </div>

    <!-- MENU YANG BISA DI SCROLL -->
    <nav class="mt-6 space-y-1 px-4 text-sm text-slate-600 flex-1 overflow-y-auto">


        <!-- Dashboard -->
        <a href="{{ route('dashboard.admin') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-xl
                  bg-indigo-50 text-indigo-700 font-semibold hover:bg-indigo-100 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 3h7v7H3V3zm11 0h7v11h-7V3zM3 13h7v8H3v-8zm11 0h7v8h-7v-8"/>
            </svg>
            Dashboard
        </a>

       {{-- STYLE UMUM MENU --}}
@php
    $menuClass = "group flex items-center gap-3 px-4 py-2 rounded-xl
                  transition-all duration-200 ease-in-out
                  hover:bg-indigo-50 hover:text-indigo-600";
@endphp


<!-- Data Buku -->
<a href="{{ route('books.index') }}" class="{{ $menuClass }}">
    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200
                group-hover:scale-105 group-hover:text-indigo-600"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M4 6a2 2 0 012-2h12v16H6a2 2 0 01-2-2V6z"/>
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M8 4v16"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Data Buku
    </span>
</a>


<!-- Tambah Buku -->
<a href="{{ route('admin.books.create') }}"
   class="group flex items-center gap-3 px-4 py-2 rounded-xl
          bg-indigo-600 text-white mt-2
          transition-all duration-200 hover:bg-indigo-700 hover:shadow-md">
    <svg class="w-5 h-5 transition-transform duration-200 group-hover:scale-105"
         fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 4v16m8-8H4"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Tambah Buku
    </span>
</a>


<!-- Kategori -->
<a href="{{ route('kategori.index') }}" class="{{ $menuClass }} mt-3">
    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200
                group-hover:scale-105 group-hover:text-indigo-600"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M4 6h16M4 12h16M4 18h10"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Kategori
    </span>
</a>


<!-- User -->
<a href="{{ route('users.index') }}" class="{{ $menuClass }} mt-3">
    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200
                group-hover:scale-105 group-hover:text-indigo-600"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <circle cx="12" cy="7" r="4"/>
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.5 21a6.5 6.5 0 0113 0"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Data Pengguna
    </span>
</a>


<!-- Petugas -->
<a href="{{ route('petugas.index') }}" class="{{ $menuClass }} mt-3">
    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200
                group-hover:scale-105 group-hover:text-indigo-600"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <circle cx="12" cy="7" r="4"/>
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.5 21a6.5 6.5 0 0113 0"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Data Petugas
    </span>
</a>


<!-- Data Peminjaman -->
<a href="{{ route('admin.peminjaman.index') }}" class="{{ $menuClass }} mt-3">
    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200
                group-hover:scale-105 group-hover:text-indigo-600"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 5a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 00-2-2H5a2 2 0 00-2 2V5z"/>
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 5a2 2 0 00-2-2h-6a2 2 0 00-2 2v14a2 2 0 012-2h6a2 2 0 012 2V5z"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Data Peminjaman
    </span>
</a>


<!-- Riwayat Peminjaman -->
<a href="{{ route('admin.riwayat.peminjaman') }}" class="{{ $menuClass }} mt-3">
    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200
                group-hover:scale-105 group-hover:text-indigo-600"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M9 5h6M9 9h6M9 13h6M5 5h.01M5 9h.01M5 13h.01"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Riwayat Peminjaman
    </span>
</a>


<!-- Riwayat Pengembalian -->
<a href="{{ route('admin.riwayat.pengembalian') }}" class="{{ $menuClass }} mt-3">
    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200
                group-hover:scale-105 group-hover:text-indigo-600"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M5 13l4 4L19 7"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Riwayat Pengembalian
    </span>
</a>


<!-- Ulasan -->
<a href="{{ route('reviews.index') }}" class="{{ $menuClass }} mt-3">
    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200
                group-hover:scale-105 group-hover:text-indigo-600"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M8 10h8m-8 4h5M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.8L3 20l1.2-3.6A7.63 7.63 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Ulasan
    </span>
</a>


<!-- Generate Laporan -->
<a href="{{ route('laporan.index') }}" class="{{ $menuClass }} mt-3">
    <svg class="w-5 h-5 text-gray-500 transition-transform duration-200
                group-hover:scale-105 group-hover:text-indigo-600"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M9 17v-6m4 6V7m4 10v-3M5 21h14M5 3h14"/>
    </svg>
    <span class="transition-transform duration-200 group-hover:translate-x-1">
        Generate Laporan
    </span>
</a>

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

    <!-- KEMBALI KE BERANDA (MENYATU SIDEBAR BAWAH) -->
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

<!-- TOMBOL PANAH -->
<button onclick="toggleSidebar()"
    class="fixed top-1/2 left-64 -translate-y-1/2 z-50
           bg-white border shadow rounded-full p-2
           hover:bg-gray-100 transition"
    id="toggleBtn">

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

            <div class="grid md:grid-cols-4 gap-6">

                <div class="bg-white border rounded-2xl shadow-sm p-6">
                    <p class="text-sm text-slate-500">Total Kategori</p>
                    <h3 class="text-3xl font-bold">{{ $totalKategori }}</h3>
                </div>

                <div class="bg-white border rounded-2xl shadow-sm p-6">
                    <p class="text-sm text-slate-500">Total Buku</p>
                    <h3 class="text-3xl font-bold">{{ $totalBuku }}</h3>
                </div>

                <div class="bg-white border rounded-2xl shadow-sm p-6">
                    <p class="text-sm text-slate-500">Total Ulasan</p>
                    <h3 class="text-3xl font-bold">{{ $totalUlasan }}</h3>
                </div>

                <div class="bg-white border rounded-2xl shadow-sm p-6">
                    <p class="text-sm text-slate-500">Total Pengguna</p>
                    <h3 class="text-3xl font-bold">{{ $totalUser }}</h3>
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
