@extends('layouts.app')

@section('title', 'Koleksi Buku')

@section('content')

<div class="pt-32 pb-24 max-w-7xl mx-auto px-6">

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="mb-6 bg-emerald-100 border border-emerald-300 text-emerald-700 px-4 py-3 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- SEARCH BAR --}}
    <form method="GET"
          action="{{ route('books.index') }}"
          class="bg-white rounded-2xl border shadow-sm p-4 mb-8 flex flex-wrap md:flex-nowrap gap-4 items-center">

        <div class="flex-1 relative">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 absolute left-3 top-3.5 text-gray-400"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
            </svg>

            <input type="text"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Cari buku, penulis, kategori..."
                   class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-100
                          focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <select name="filter"
                class="px-4 py-3 rounded-xl bg-gray-100 focus:outline-none">
            <option value="judul" {{ request('filter') === 'judul' ? 'selected' : '' }}>Judul</option>
            <option value="penulis" {{ request('filter') === 'penulis' ? 'selected' : '' }}>Penulis</option>
            <option value="kategori" {{ request('filter') === 'kategori' ? 'selected' : '' }}>Kategori</option>
        </select>

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

        @if(request('q'))
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

    {{-- TITLE --}}
    <h2 class="text-lg font-semibold mb-6 text-slate-700">
        {{ request('q') ? 'Hasil pencarian untuk' : 'Menampilkan' }}
        <span class="font-bold text-indigo-600">
            "{{ request('q') ?: 'Semua Buku' }}"
        </span>
    </h2>

    {{-- CONTENT --}}
    @if(isset($books) && $books->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

            @foreach ($books as $book)

                @php
                    $sudahAda = auth()->check()
                        ? auth()->user()->koleksiBuku->contains($book->id)
                        : false;

                    $stok = $book->stok ?? 0;
                @endphp

                <div class="bg-white rounded-2xl border shadow-sm hover:shadow-xl transition 
                            overflow-hidden flex flex-col h-full">

                    {{-- COVER --}}
                    <div class="relative group overflow-hidden">
                            <img
                            src="{{ $book->cover 
                                ? asset('covers/' . $book->cover) . '?v=' . time()
                                : asset('images/buku1.jpeg') }}"
                            alt="{{ $book->judul }}"
                            class="w-full h-64 object-cover transition duration-300 group-hover:scale-105"
                            onerror="this.src='{{ asset('images/buku1.jpeg') }}'">

                        <div class="absolute inset-0 bg-black/50 opacity-0 
                                    group-hover:opacity-100 
                                    flex items-center justify-center
                                    transition duration-300">

                         <a href="{{ route('books.show', $book->id) }}"
   class="group flex items-center gap-2 bg-white text-indigo-600 px-4 py-2 rounded-lg text-sm font-semibold
          shadow-md hover:bg-indigo-600 hover:text-white transition">

    {{-- ICON MATA --}}
    <svg xmlns="http://www.w3.org/2000/svg"
         class="w-5 h-5 transition-transform duration-300 group-hover:scale-110"
         viewBox="0 0 24 24"
         fill="none"
         stroke="currentColor"
         stroke-width="1.8">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M2.25 12s3.75-7.5 9.75-7.5S21.75 12 21.75 12
                 18 19.5 12 19.5 2.25 12 2.25 12z" />

        <circle cx="12"
                cy="12"
                r="3"
                stroke-linecap="round"
                stroke-linejoin="round" />
    </svg>

    <span>Lihat Detail</span>
</a>
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-4 flex flex-col flex-1">

                        <h3 class="font-semibold text-sm line-clamp-2 mb-1">
                            {{ $book->judul }}
                        </h3>

                        <p class="text-xs text-gray-500">
                            {{ $book->penulis }}
                        </p>

                        <p class="text-xs text-indigo-500 mb-2">
                            {{ $book->kategori->nama ?? '' }}
                        </p>

                        {{-- DETAIL TAMBAHAN --}}
                        <div class="text-xs text-gray-600 space-y-1 mb-3">
                            <p><span class="font-semibold">ISBN:</span> {{ $book->isbn ?? '-' }}</p>
                            <p><span class="font-semibold">Penerbit:</span> {{ $book->penerbit ?? '-' }}</p>
                            <p><span class="font-semibold">Tahun:</span> {{ $book->tahun_terbit ?? '-' }}</p>
                        </div>

                        {{-- BADGE STOK --}}
                        <div class="mt-auto mb-3">
                            @if($stok > 5)
                                <div class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-700">
                                    Stok tersedia: {{ $stok }}
                                </div>
                            @elseif($stok > 0)
                                <div class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                    Stok terbatas: {{ $stok }}
                                </div>
                            @else
                                <div class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700">
                                    Stok habis
                                </div>
                            @endif
                        </div>

                        {{-- USER BUTTON --}}
                        @auth
                        @if(auth()->user()->role === 'user')
                            @if(!$sudahAda)
                           <form action="{{ route('koleksi.store', $book->id) }}" method="POST">
    @csrf
    <button
        class="group w-full flex items-center justify-center gap-2 
               bg-gradient-to-r from-indigo-600 to-indigo-700
               text-white py-2.5 rounded-xl text-xs font-semibold
               shadow-md hover:shadow-lg
               hover:from-indigo-700 hover:to-indigo-800
               transform hover:-translate-y-0.5
               transition-all duration-200 ease-in-out">

        <!-- Icon Book -->
        <svg xmlns="http://www.w3.org/2000/svg"
         class="w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke="currentColor"
         stroke-width="2">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M4 5a2 2 0 012-2h10a2 2 0 012 2v14l-7-3-7 3V5z" />
    </svg>

        <span class="transition group-hover:translate-x-1">
            Tambah ke Koleksi
        </span>
    </button>
</form>
                            @else
                                <p class="text-emerald-600 text-xs text-center font-medium">
                                    ✓ Sudah di Koleksi
                                </p>
                            @endif
                        @endif
                        @endauth

                        {{-- ADMIN BUTTON --}}
                        @auth
                        @if(auth()->user()->role === 'admin')
                        <div class="mt-4 pt-3 border-t flex items-center justify-between text-xs font-semibold">

                            {{-- EDIT --}}
                            <a href="{{ route('admin.books.edit', $book->id) }}"
                               class="flex items-center gap-1 text-amber-600 hover:text-amber-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-4 h-4"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M11 5h2m-1-1v2m7.414 2.586
                                             a2 2 0 010 2.828l-9.9 9.9a1 1 0 01-.42.26l-4 1
                                             a1 1 0 01-1.213-1.213l1-4a1 1 0 01.26-.42l9.9-9.9
                                             a2 2 0 012.828 0z" />
                                </svg>
                                <span>Edit</span>
                            </a>

                            {{-- HAPUS --}}
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')

                                   <button
type="button"
class="btn-hapus flex items-center justify-center gap-2
mx-auto
text-red-600 hover:text-red-700
font-semibold transition">

<svg xmlns="http://www.w3.org/2000/svg"
     class="w-4 h-4"
     fill="none"
     viewBox="0 0 24 24"
     stroke="currentColor"
     stroke-width="2">

<path stroke-linecap="round"
      stroke-linejoin="round"
      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
         a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9
         7h6m2 0H7m3-3h4a1 1 0 011 1v1H9V5a1
         1 0 011-1z"/>
</svg>

Hapus

</button>


                            </form>

                        </div>
                        @endif
                        @endauth

                    </div>
                </div>

            @endforeach

        </div>
    @endif

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