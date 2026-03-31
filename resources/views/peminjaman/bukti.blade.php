@extends('layouts.app')

@section('title', 'Bukti Peminjaman')

@section('content')
<div class="max-w-3xl mx-auto mt-20 mb-20 bg-white shadow-lg rounded-xl p-8 print:shadow-none print:p-0">

    {{-- HEADER --}}
    <div class="text-center border-b pb-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            BUKTI PEMINJAMAN BUKU
        </h1>
        <p class="text-sm text-gray-500">
            Perpustakaan Digital
        </p>
    </div>

    {{-- DATA --}}
    <div class="space-y-4 text-gray-700">

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="font-semibold">Nama Peminjam</p>
                <p>{{ $pinjam->user->name }}</p>
            </div>

            <div>
                <p class="font-semibold">Email</p>
                <p>{{ $pinjam->user->email }}</p>
            </div>
        </div>

        <hr>

        <div>
            <p class="font-semibold">Judul Buku</p>
            <p>{{ $pinjam->book->judul }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="font-semibold">Tanggal Peminjaman</p>
                <p>{{ \Carbon\Carbon::parse($pinjam->tanggal_peminjaman)->format('d M Y') }}</p>
            </div>

            <div>
                <p class="font-semibold">Tanggal Pengembalian</p>
                <p>
                    {{ \Carbon\Carbon::parse($pinjam->tanggal_pengembalian)->format('d M Y') }}
                </p>
            </div>
        </div>

        <div>
            <p class="font-semibold">Status</p>
            <span class="px-3 py-1 rounded-full text-sm font-semibold
                @if($pinjam->status_peminjaman == 'Dipinjam') bg-blue-100 text-blue-700
                @elseif($pinjam->status_peminjaman == 'Dikembalikan') bg-green-100 text-green-700
                @elseif($pinjam->status_peminjaman == 'Ditolak') bg-red-100 text-red-700
                @else bg-yellow-100 text-yellow-700
                @endif">
                {{ $pinjam->status_peminjaman }}
            </span>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="mt-10 text-right text-sm text-gray-500">
        Dicetak pada: {{ now()->format('d M Y H:i') }}
    </div>

    {{-- BUTTON --}}
    <div class="mt-8 flex justify-between print:hidden">
        <a href="{{ route('peminjaman.index') }}"
           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
            Kembali
        </a>

        <button onclick="window.print()"
            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Cetak
        </button>
    </div>

</div>
@endsection