@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 to-blue-100 py-12">
    <div class="max-w-3xl mx-auto px-4">

        <div class="bg-white shadow-2xl rounded-3xl p-10 border border-gray-100">

            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-indigo-700 tracking-wide">
                    Bukti Peminjaman Buku
                </h2>
                <p class="text-gray-500 mt-2">
                    Sistem Informasi Perpustakaan Digital
                </p>
            </div>

            <!-- Nomor Transaksi -->
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 mb-6 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Kode Transaksi</span>
                    <span class="font-semibold text-indigo-700">
                        TRX-{{ $peminjaman->id }}
                    </span>
                </div>
                <div class="flex justify-between mt-2">
                    <span class="text-gray-500">Tanggal Cetak</span>
                    <span>{{ now()->format('d-m-Y') }}</span>
                </div>
            </div>

            <!-- Detail -->
            <div class="space-y-5 text-sm">

                <div class="flex justify-between border-b pb-3">
                    <span class="text-gray-500">Nama Peminjam</span>
                    <span class="font-semibold">
                        {{ $peminjaman->user->name }}
                    </span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="text-gray-500">Judul Buku</span>
                    <span class="font-semibold">
                        {{ $peminjaman->book->judul }}
                    </span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="text-gray-500">Tanggal Pinjam</span>
                    <span>
                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d-m-Y') }}
                    </span>
                </div>

                <div class="flex justify-between border-b pb-3">
                    <span class="text-gray-500">Tanggal Kembali</span>
                    <span>
                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d-m-Y') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Status</span>

                    @if($peminjaman->status_peminjaman == 'Dipinjam')
                        <span class="px-4 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                            Sedang Dipinjam
                        </span>
                    @else
                        <span class="px-4 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                            Sudah Dikembalikan
                        </span>
                    @endif
                </div>

            </div>

            <!-- Footer Buttons -->
            <div class="mt-10 flex justify-between">

                <!-- Tombol Kembali -->
                <a href="{{ route('peminjaman.index') }}"
                   class="inline-flex items-center gap-2 px-6 py-2 
                          bg-gray-500 hover:bg-gray-600 
                          text-white rounded-xl shadow 
                          transition duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 19l-7-7 7-7" />
                    </svg>

                    Kembali
                </a>

                <!-- Tombol Cetak -->
                <button onclick="window.print()"
                        class="inline-flex items-center gap-2 px-6 py-2 
                               bg-indigo-600 hover:bg-indigo-700 
                               text-white rounded-xl shadow-md 
                               hover:scale-105 transform 
                               transition duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M6 9V4h12v5M6 18h12v-6H6v6zm-2-6h16a2 2 0 012 2v4H2v-4a2 2 0 012-2z"/>
                    </svg>

                    Cetak Bukti
                </button>

            </div>

        </div>
    </div>
</div>
@endsection