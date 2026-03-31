@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10">
    <div class="w-full max-w-lg bg-white shadow-xl rounded-2xl p-8">

    {{-- HEADER --}}
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Pinjam Buku</h1>
        <p class="text-gray-500 text-sm mt-1">Isi data peminjaman buku dengan benar</p>
    </div>

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
            <strong class="block font-semibold mb-2">Terjadi kesalahan:</strong>
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('peminjaman.store') }}" class="space-y-6">
    @csrf

    {{-- PILIH BUKU --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Pilih Buku
        </label>

        <div class="relative">

            {{-- ICON BUKU --}}
            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.405
                        9.245 5 7.5 5S4.168 5.405
                        3 6.253v13C4.168 18.405
                        5.755 18 7.5 18s3.332.405
                        4.5 1.253m0-13C13.168
                        5.405 14.755 5 16.5
                        5s3.332.405 4.5
                        1.253v13C19.832
                        18.405 18.245 18
                        16.5 18s-3.332.405-4.5
                        1.253"/>
                </svg>
            </div>

            <select name="book_id"
                class="w-full appearance-none border border-gray-300 rounded-xl pl-10 pr-10 py-3
                focus:ring-2 focus:ring-indigo-400 focus:outline-none transition cursor-pointer"
                required>

                <option value="">-- Pilih Buku --</option>

                @foreach($books as $b)

                <option value="{{ $b->id }}"
                    {{ old('book_id') == $b->id ? 'selected' : '' }}>

                    {{ $b->judul }} — {{ $b->penulis }}

                </option>

                @endforeach

            </select>

            {{-- ICON ARROW --}}
            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 9l-7 7-7-7"/>

                </svg>

            </div>

        </div>
    </div>

    {{-- TANGGAL PINJAM --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Tanggal Pinjam
        </label>

        <input type="date"
            name="tanggal_peminjaman"
            value="{{ old('tanggal_peminjaman', date('Y-m-d')) }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
            required>
    </div>

    {{-- TANGGAL KEMBALI --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Tanggal Pengembalian
        </label>

        <input type="date"
            name="tanggal_pengembalian"
            value="{{ old('tanggal_pengembalian') }}"
            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"
            required>
    </div>

    {{-- BUTTON --}}
    <div class="flex gap-4 pt-4">

        <button type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md transition">
            Simpan
        </button>

        <a href="{{ route('peminjaman.index') }}"
            class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 rounded-lg shadow-sm transition">
            Batal
        </a>

    </div>

    </form>
</div>

</div>
@endsection
