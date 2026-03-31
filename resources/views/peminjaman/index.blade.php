@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-7xl mx-auto px-4">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Data Peminjaman
                </h1>
                <p class="text-gray-500 text-sm mt-1">
                    Daftar buku yang sedang dan telah dipinjam
                </p>

                @if(auth()->user()->role == 'user')
                    <p class="text-xs text-indigo-600 mt-2">
                        Menampilkan data peminjaman milik Anda
                    </p>
                @endif
            </div>

            <a href="{{ route('peminjaman.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg shadow-md transition font-semibold">
                + Pinjam Buku
            </a>
        </div>

        {{-- SEARCH BAR --}}
        <div class="mb-6">
            <form method="GET" action="{{ route(Route::currentRouteName()) }}" class="flex gap-3">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama user atau judul buku..."
                       class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">

                <button type="submit"
                class="flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-xl
                       hover:bg-indigo-700 transition font-semibold shadow-md">
                 
                        <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                    Cari
                </button>

                @if(request()->filled('search'))
                    <a href="{{ route(Route::currentRouteName()) }}"
   class="group flex items-center justify-center
          w-11 h-11
          bg-gray-100 hover:bg-indigo-50
          rounded-xl
          transition-all duration-300 shadow-sm hover:shadow-md"
   title="Reset Pencarian">

    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-5 h-5 text-gray-600
                group-hover:text-indigo-600
                group-hover:rotate-180
                transition-all duration-500"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor"
         stroke-width="2.5">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M4 4v6h6M20 20v-6h-6" />

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M20 9a8 8 0 00-14.9-3
                 M4 15a8 8 0 0014.9 3" />
    </svg>
</a>
                @endif
            </form>
        </div>

        {{-- CARD TABLE --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">User</th>
                        <th class="px-6 py-4 text-left">Buku</th>
                        <th class="px-6 py-4 text-left">Tanggal Pinjam</th>
                        <th class="px-6 py-4 text-left">Tanggal Kembali</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                @forelse($data as $d)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 font-medium">{{ $d->user->name }}</td>
                        <td class="px-6 py-4">{{ $d->book->judul }}</td>
                        <td class="px-6 py-4">{{ $d->tanggal_peminjaman }}</td>
                        <td class="px-6 py-4">
                            {{ $d->tanggal_pengembalian ?? '-' }}
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4 text-center">
    @switch($d->status_peminjaman)

        @case('Menunggu')
            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                Menunggu
            </span>
        @break

        @case('Dipinjam')
            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                Dipinjam
            </span>
        @break

        @case('Menunggu Pengembalian')
            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">
                Menunggu
            </span>
        @break

        @case('Dikembalikan')
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                Dikembalikan
            </span>
        @break

        @case('Ditolak')
            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                Ditolak
            </span>
        @break

    @endswitch
</td>

       {{-- AKSI --}}
<td class="px-6 py-4 text-center">
<div class="flex flex-col items-center gap-2 w-28 mx-auto">


{{-- Tombol Bukti --}}
<a href="{{ route('user.bukti', $d->id) }}"
class="inline-flex items-center justify-center gap-1 w-full px-3 py-2 text-xs
bg-indigo-600 text-white rounded-lg
hover:bg-indigo-700 transition shadow-sm">

<svg class="w-4 h-4" fill="none" stroke="currentColor"
stroke-width="2" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round"
d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v14l-5-3-5 3V6a2 2 0 012-2z"/>
</svg>

Bukti
</a>

{{-- Jika Buku Dipinjam --}}
@if($d->status_peminjaman == 'Dipinjam')

<form method="POST" action="{{ route('pengembalian.ajukan', $d->id) }}" class="w-full">
@csrf

<button
class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg shadow-sm text-xs font-semibold transition">
Kembalikan
</button>

</form>

{{-- Jika Buku Sudah Dikembalikan --}}
@elseif($d->status_peminjaman == 'Dikembalikan')

    {{-- Jika belum ulasan --}}
@php
$review = \App\Models\Review::where('user_id', auth()->id())
            ->where('book_id', $d->book->id)
            ->exists();
@endphp

@if(!$review)

<a href="{{ route('review.create', $d->book->id) }}"
class="inline-flex items-center justify-center gap-2 w-full px-3 py-2 text-xs
bg-indigo-600 hover:bg-indigo-700
text-white font-semibold
rounded-lg shadow-md
transition duration-300 transform hover:scale-105">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-4 h-4"
fill="currentColor"
viewBox="0 0 24 24">
<path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828
1.548 8.278L12 18.896l-7.484 4.516
1.548-8.278L0 9.306l8.332-1.151z"/>
</svg>

Ulas Buku

</a>

@else

<span class="text-gray-500 text-xs font-semibold">
Selesai
</span>

@endif

@else

<span class="text-gray-500 text-xs font-semibold">
    Menunggu
</span>

@endif

</div>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-10 text-gray-400">
                            Data tidak ditemukan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $data->withQueryString()->links() }}
        </div>

        {{-- BUTTON KEMBALI DASHBOARD --}}
        <div class="mt-8">
            <a href="{{ route('dashboard.user') }}"
           class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 
                  px-5 py-2.5 rounded-xl hover:bg-gray-300 transition 
                  font-medium shadow-sm">
            ← Kembali
        </a>
        </div>

    </div>
</div>


@endsection