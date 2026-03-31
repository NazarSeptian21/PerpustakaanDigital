@extends('layouts.app')

@section('content')
<div class="p-8 bg-gray-100 min-h-screen flex flex-col justify-between">

    <div>
        {{-- HEADER --}}
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-800">
                Generate Laporan
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                Unduh laporan data perpustakaan dalam format PDF
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            {{-- LAPORAN PEMINJAMAN --}}
            <div class="bg-white p-7 rounded-2xl shadow-md hover:shadow-xl transition border border-gray-100">

                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-teal-100 text-teal-600 p-3 rounded-xl">
                        📚
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Laporan Peminjaman Dan Pengembalian Buku
                    </h3>
                </div>

                <p class="text-sm text-gray-500 leading-relaxed">
                    Rekap data peminjaman dan pengembalian buku oleh pengguna
                    berdasarkan aktivitas terbaru.
                </p>

                <a href="{{ route('laporan.cetak', ['type' => 'peminjaman']) }}"
                   class="inline-block mt-6 px-5 py-2.5
                          bg-teal-600 text-white text-sm font-medium
                          rounded-lg shadow hover:bg-teal-700 transition">
                    Cetak PDF
                </a>
            </div>

            {{-- LAPORAN DATA BUKU --}}
            <div class="bg-white p-7 rounded-2xl shadow-md hover:shadow-xl transition border border-gray-100">

                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-indigo-100 text-indigo-600 p-3 rounded-xl">
                        📖
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">
                        Laporan Data Buku
                    </h3>
                </div>

                <p class="text-sm text-gray-500 leading-relaxed">
                    Rekap jumlah buku, kategori, serta daftar koleksi buku
                    yang tersedia di perpustakaan.
                </p>

                <a href="{{ route('laporan.cetak', ['type' => 'buku']) }}"
                   class="inline-block mt-6 px-5 py-2.5
                          bg-indigo-600 text-white text-sm font-medium
                          rounded-lg shadow hover:bg-indigo-700 transition">
                    Cetak PDF
                </a>
            </div>

        </div>
    </div>

   
    {{-- BUTTON KEMBALI --}}
    <div class="mt-12">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 
                  px-5 py-2.5 rounded-xl hover:bg-gray-300 transition 
                  font-medium shadow-sm">
            ← Kembali
        </a>
</div>

</div>
@endsection
