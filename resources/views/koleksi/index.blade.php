@extends('layouts.app')

@section('title', 'Koleksi Pribadi')

@section('content')
<div class="pt-28 pb-28 max-w-7xl mx-auto px-6 relative">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2">
            Koleksi Pribadi Saya
        </h1>
        <p class="text-slate-500">
            Buku favorit yang sudah kamu simpan
        </p>
    </div>

    {{-- SEARCH BAR --}}
    <div class="mb-6">
        <form method="GET" action="{{ route(Route::currentRouteName()) }}" class="flex gap-3">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari berdasarkan judul buku..."
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

    {{-- ALERT --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if($books->count())

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-7">

            @foreach($books as $book)

                @php
                    $sedangDipinjam = in_array($book->id, $bukuSedangDipinjam ?? []);
                @endphp

                <div class="bg-white rounded-2xl shadow hover:shadow-2xl
                            hover:-translate-y-1 transition duration-300
                            overflow-hidden flex flex-col relative">

                    {{-- BADGE --}}
                    @if($sedangDipinjam)
                        <span class="absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                            Dipinjam
                        </span>
                    @endif

                    {{-- COVER --}}
                    <img
                        src="{{ $book->cover ? asset('covers/'.$book->cover) : asset('images/buku1.jpeg') }}"
                        class="w-full h-60 object-cover"
                        onerror="this.src='{{ asset('images/buku1.jpeg') }}'">

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

                        {{-- DETAIL --}}
                        <div class="text-xs text-gray-600 space-y-1 mb-3">
                            <div><b>ISBN</b> : {{ $book->isbn ?? '-' }}</div>
                            <div><b>Penerbit</b> : {{ $book->penerbit ?? '-' }}</div>
                            <div><b>Tahun</b> : {{ $book->tahun_terbit ?? '-' }}</div>
                        </div>

                        {{-- RATING --}}
                        <div class="flex items-center gap-1 mb-4">
                            @php $avg = round($book->reviews_avg_rating ?? 0); @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-3 h-3 {{ $i <= $avg ? 'text-yellow-400' : 'text-gray-300' }}"
                                     fill="currentColor"
                                     viewBox="0 0 20 20">
                                    <path d="M9.049 2.927L12.2 6.3 15.8 6.6 13.9 11.4
                                             14.7 14.9 10 14.7 7.4 16.3 6.1 11.4
                                             3.4 9.1 7.8 6.3Z"/>
                                </svg>
                            @endfor
                            <span class="text-xs text-gray-500 ml-1">
                                ({{ number_format($book->reviews_avg_rating ?? 0,1) }})
                            </span>
                        </div>

                        {{-- BUTTON AREA --}}
                        <div class="mt-auto flex flex-col gap-2">

                            @if(!$sedangDipinjam)
                                <a href="{{ route('peminjaman.create',['book_id'=>$book->id]) }}"
   class="w-full flex items-center justify-center gap-2
          bg-indigo-600 text-white
          py-2 rounded-lg text-xs font-medium
          hover:bg-indigo-700 transition shadow">

    {{-- ICON BUKU --}}
  
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4 transition-transform duration-200
                    group-hover:rotate-6 group-hover:scale-110"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="1.8">

            <!-- Book -->
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 6a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 00-2-2H6a2 2 0 00-2 2V6z"/>

            <!-- Plus -->
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 9v6m3-3H9"/>
        </svg>



    Pinjam Buku
</a>
                            @else
                                <button disabled
                                    class="w-full bg-gray-400 text-white
                                           py-2 rounded-lg text-xs font-medium cursor-not-allowed">
                                    Sedang Dipinjam
                                </button>
                            @endif

                           <form action="{{ route('koleksi.destroy', $book->id) }}" method="POST">
@csrf
@method('DELETE')

<button
type="button"
class="btn-hapus w-full flex items-center justify-center gap-2
py-2
border border-red-500 rounded-lg
text-xs font-medium
text-red-600
hover:bg-red-600 hover:text-white
transition">

<svg xmlns="http://www.w3.org/2000/svg"
     class="w-4 h-4"
     fill="none"
     viewBox="0 0 24 24"
     stroke="currentColor"
     stroke-width="1.8">

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
                            </form>

                        </div>

                    </div>
                </div>

            @endforeach

        </div>

        {{-- PAGINATION --}}
        <div class="mt-10">
            {{ $books->withQueryString()->links() }}
        </div>

    @else
        <div class="bg-white rounded-2xl shadow p-14 text-center">
            <div class="text-6xl mb-4">📚</div>
            <h3 class="text-xl font-semibold mb-2">
                Koleksi Masih Kosong
            </h3>
            <p class="text-gray-500 mb-6">
                Kamu belum menyimpan buku favorit.
            </p>
            <a href="{{ route('books.index') }}"
               class="inline-block bg-indigo-600 text-white
                      px-7 py-3 rounded-xl hover:bg-indigo-700 transition">
                Jelajahi Buku
            </a>
        </div>
    @endif

    {{-- BUTTON KEMBALI --}}
    <div class="mt-6">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 
                  px-5 py-2.5 rounded-xl hover:bg-gray-300 transition 
                  font-medium shadow-sm">
            ← Kembali
        </a>
    </div>

</div>
@endsection