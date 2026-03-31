@extends('layouts.app')

@section('title', 'Detail Buku - Perpustakaan Digital')

@section('styles')
<script>
    // Custom success alert timeout
    setTimeout(() => {
        const alert = document.getElementById('successAlert');
        if(alert){
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">

    {{-- ================= NOTIFIKASI SUCCESS ================= --}}
    @if(session('success'))
        <div id="successAlert"
             class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg shadow-sm text-sm transition-opacity duration-500">
            {{ session('success') }}
        </div>
    @endif
    {{-- ======================================================= --}}

    <div class="bg-white rounded-xl shadow-md overflow-hidden grid md:grid-cols-3 gap-6 p-6">

        {{-- COVER --}}
        <div>
            @if($book->cover)
                <img src="{{ asset('covers/' . $book->cover) }}"
                     class="rounded-lg shadow w-full h-96 object-cover">
            @else
                <div class="bg-gray-200 h-72 flex items-center justify-center rounded-lg">
                    <span class="text-gray-500 text-sm">Tidak ada cover</span>
                </div>
            @endif
        </div>

        {{-- DETAIL --}}
        <div class="md:col-span-2 space-y-4">

            <h1 class="text-2xl font-bold text-gray-800">
                {{ $book->judul }}
            </h1>

            <div class="space-y-1 text-gray-700 text-sm">
                <p><strong>Penulis:</strong> {{ $book->penulis }}</p>
                <p><strong>Kategori:</strong> {{ $book->kategori->nama ?? '-' }}</p>
                <p><span class="font-semibold">ISBN:</span> {{ $book->isbn }}</p>
                <p><span class="font-semibold">Penerbit:</span> {{ $book->penerbit }}</p>
                <p><span class="font-semibold">Tahun Terbit:</span> {{ $book->tahun_terbit }}</p>

                {{-- STOK BADGE --}}
                <div>
                    <strong>Stok:</strong>
                    @if($book->stok > 0)
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold ml-2">
                            {{ $book->stok }} Tersedia
                        </span>
                    @else
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold ml-2">
                            Stok Habis
                        </span>
                    @endif
                </div>

                {{-- RATING --}}
                <div class="mt-3">
                    <strong class="block mb-1 text-sm text-gray-700">Rating:</strong>

                    @php
                        $avgRating = $book->reviews_avg_rating ?? 0;
                        $rounded = round($avgRating);
                    @endphp

                    <div class="flex items-center gap-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $rounded ? 'text-yellow-400' : 'text-gray-300' }}"
                                 fill="currentColor"
                                 viewBox="0 0 20 20">
                                <path d="M9.049 2.927L12.2 6.3 15.8 6.6 13.9 11.4
                                         14.7 14.9 10 14.7 7.4 16.3 6.1 11.4
                                         3.4 9.1 7.8 6.3Z"/>
                            </svg>
                        @endfor

                        <span class="text-sm text-gray-600 ml-2">
                            {{ number_format($avgRating, 1) }} / 5
                        </span>
                    </div>

                    @if($avgRating == 0)
                        <p class="text-xs text-gray-400 mt-1">
                            Belum ada ulasan
                        </p>
                    @endif
                </div>

                {{-- ================= USER ACTION ================= --}}
                @auth
                @if(auth()->user()->role === 'user')
                    @if($book->stok > 0)
                    <form action="{{ route('peminjaman.store') }}" method="POST" class="pt-4">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        <input type="hidden" name="tanggal_peminjaman" value="{{ now()->format('Y-m-d') }}">
                        <input type="hidden" name="tanggal_pengembalian" value="{{ now()->addDays(7)->format('Y-m-d') }}">
                        <button class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium shadow-md hover:bg-indigo-700 hover:shadow-lg active:scale-95 transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042c-1.5-1.5-4.5-1.5-6 0v12c1.5-1.5 4.5-1.5 6 0m0-11.958c1.5-1.5 4.5-1.5 6 0v12c-1.5-1.5-4.5-1.5-6 0" />
                            </svg>
                            Pinjam Buku
                        </button>
                    </form>
                    @else
                        <button disabled class="bg-gray-400 text-white px-5 py-2 rounded-lg text-sm cursor-not-allowed mt-4">
                            Stok Tidak Tersedia
                        </button>
                    @endif
                @endif
                @endauth

                {{-- ================= ADMIN ACTION ================= --}}
                @auth
                @if(auth()->user()->role === 'admin')
                <div class="border-t pt-4 mt-4">
                    <h3 class="font-semibold mb-2 text-sm">Tambah Stok</h3>
                    <form action="{{ route('books.tambahStok', $book->id) }}" method="POST" class="flex gap-2 items-center">
                        @csrf
                        <input type="number" name="jumlah" min="1" required placeholder="Jumlah" class="border px-3 py-2 rounded-lg w-24 text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <button class="group flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md hover:shadow-lg hover:from-blue-700 hover:to-blue-800 transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform duration-200 group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v8m4-4H8"/>
                            </svg>
                            <span class="transition group-hover:translate-x-1">Tambah</span>
                        </button>
                    </form>
                </div>
                @endif
                @endauth

            </div>
        </div>

    </div>

    {{-- BUTTON KEMBALI --}}
    <div class="mt-6">
        <a href="{{ route('books.index') }}"
           class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 
                  px-5 py-2.5 rounded-xl hover:bg-gray-300 transition 
                  font-medium shadow-sm">
            ← Kembali
        </a>
    </div>

</div>
@endsection
