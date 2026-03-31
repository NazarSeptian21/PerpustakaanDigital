@extends('layouts.app')

@section('content')


<div class="flex min-h-screen bg-gray-100">

    {{-- SIDEBAR --}}
    <aside id="sidebar"
        class="w-64 bg-gray-50 border-r border-gray-200
               transition-all duration-300 ease-in-out
               flex flex-col overflow-hidden">

        <div class="p-6">
            <h2 class="text-xl font-bold text-indigo-600">
                Petugas Panel
            </h2>
            <p class="text-xs text-gray-500">Perpustakaan Digital</p>
        </div>

        <nav class="px-3 space-y-1 text-sm text-gray-700 flex-1 overflow-y-auto">

            {{-- DASHBOARD --}}
              <a href="{{ route('dashboard.petugas') }}"
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

  <!--Data peminjaman-->
      <a href="{{ route('admin.peminjaman.index') }}"
   class="group flex items-center gap-3 px-4 py-2 rounded-lg transition
          hover:bg-indigo-50 hover:text-indigo-600">

    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-5 h-5 text-gray-500 transition
                group-hover:text-indigo-600 group-hover:scale-110"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="1.8">

        <!-- Buku Terbuka -->
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 5a2 2 0 012-2h6a2 2 0 012 2v14a2 2 0 00-2-2H5a2 2 0 00-2 2V5z"/>

        <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 5a2 2 0 00-2-2h-6a2 2 0 00-2 2v14a2 2 0 012-2h6a2 2 0 012 2V5z"/>

        <!-- Panah Peminjaman -->
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9l3 3-3 3"/>
    </svg>

    <span class="transition group-hover:translate-x-1">
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

            {{-- LOGOUT --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf

                <button
                    type="button"
                    onclick="confirmLogout()"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-red-100 text-red-600 w-full text-left transition">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17 16l4-4m0 0l-4-4m4 4H7M7 4v16"/>
                    </svg>

                    Logout
                </button>
            </form>

        </nav>

        {{-- KEMBALI --}}
        <div class="mt-auto px-3 pb-4 text-sm text-gray-700">
            <a href="{{ route('landing') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-200 transition">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 19l-7-7 7-7"/>
                </svg>

                Kembali
            </a>
        </div>

    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10 relative">

        {{-- TOGGLE SIDEBAR TENGAH --}}
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

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Petugas</h1>
            <p class="text-gray-500">Selamat datang, {{ auth()->user()->name }}</p>
        </div>

        {{-- CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <p class="text-gray-500 text-sm">Total Buku</p>
                <h3 class="text-3xl font-bold mt-2">{{ $totalBuku }}</h3>
            </div>

            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <p class="text-gray-500 text-sm">Kategori</p>
                <h3 class="text-3xl font-bold mt-2">{{ $totalKategori }}</h3>
            </div>

            <div class="bg-white border rounded-2xl p-6 shadow-sm">
                <p class="text-gray-500 text-sm">Dipinjam Hari Ini</p>
                <h3 class="text-3xl font-bold mt-2">{{ $totalDipinjam }}</h3>
            </div>

        </div>

        {{-- ACTIVITY --}}
        <div class="mt-10 bg-white p-6 rounded-2xl shadow-sm border">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Aktivitas Terakhir</h2>

            <div class="space-y-3 text-sm text-gray-600">
                @forelse($activities as $act)
                    <div class="flex justify-between border-b pb-2">
                        <span>
                            <strong>{{ $act->user_name }}</strong>
                            {{ $act->action }}
                        </span>
                        <span class="text-gray-400">
                            {{ $act->created_at->diffForHumans() }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400">Belum ada aktivitas.</p>
                @endforelse
            </div>
        </div>

    </main>
</div>

{{-- SCRIPT --}}
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const button = document.querySelector('button[onclick="toggleSidebar()"]');

    if (sidebar.classList.contains('w-0')) {
        sidebar.classList.remove('w-0');
        sidebar.classList.add('w-64');
        button.classList.remove('left-4');
        button.classList.add('left-64');
    } else {
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-0');
        button.classList.remove('left-64');
        button.classList.add('left-4');
    }
}
</script>

@endsection
