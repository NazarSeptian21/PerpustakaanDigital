@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto py-10 px-6">

<!-- HEADER -->
<h1 class="text-3xl font-bold text-gray-800 mb-6">
    @if(auth()->user()->role === 'admin')
        Data Semua Ulasan
    @else
        Ulasan Saya
    @endif
</h1>

<!-- SEARCH -->
<form method="GET" action="{{ route('reviews.index') }}" class="mb-6 flex items-center gap-3">
    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Cari buku, user, atau komentar..."
           class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">

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
                  d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
        </svg>

        Cari
    </button>

    @if(request('search'))
    <a href="{{ route(Route::currentRouteName()) }}"
       class="group flex items-center justify-center
       w-11 h-11
       bg-gray-100 hover:bg-indigo-50
       rounded-xl transition-all duration-300
       shadow-sm hover:shadow-md"
       title="Reset Pencarian">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-5 h-5 text-gray-600
             group-hover:text-indigo-600
             group-hover:rotate-180 transition-all duration-500"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="2.5">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M4 4v6h6M20 20v-6h-6"/>

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M20 9a8 8 0 00-14.9-3
                     M4 15a8 8 0 0014.9 3"/>
        </svg>
    </a>
    @endif
</form>

<!-- NOTIFIKASI -->
@if(session('success'))
<div id="alertSuccess"
     class="mb-6 px-6 py-4 rounded-xl bg-green-100 border border-green-300 text-green-800 shadow">
    {{ session('success') }}
</div>

<script>
    setTimeout(() => {
        const alert = document.getElementById('alertSuccess');
        if(alert){
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
</script>
@endif


<!-- TAMBAH ULASAN -->
@if(auth()->user()->role !== 'admin')
    <a href="{{ route('reviews.create') }}"
       class="mb-6 inline-block bg-indigo-600 text-white px-5 py-2 rounded-xl shadow hover:bg-indigo-700 transition">
        + Tambah Ulasan
    </a>
@endif


<!-- TABLE -->
<div class="bg-white rounded-2xl shadow border overflow-hidden">

    <table class="w-full text-left">

        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Buku</th>

                @if(auth()->user()->role === 'admin')
                <th class="px-6 py-4">User</th>
                @endif

                <th class="px-6 py-4">Rating</th>
                <th class="px-6 py-4">Komentar</th>

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'user')
                <th class="px-6 py-4 text-center w-32">Aksi</th>
                @endif
            </tr>
        </thead>


        <tbody class="divide-y">

        @forelse($reviews as $index => $review)

        <tr class="hover:bg-gray-50">

            <td class="px-6 py-4">
                {{ $reviews->firstItem() + $index }}
            </td>

            <td class="px-6 py-4 font-medium">
                {{ $review->book->judul ?? '-' }}
            </td>

            @if(auth()->user()->role === 'admin')
            <td class="px-6 py-4">
                {{ $review->user->name ?? '-' }}
            </td>
            @endif

            <td class="px-6 py-4 text-yellow-500">
                ⭐ {{ $review->rating }}
            </td>

            <td class="px-6 py-4 text-gray-600">
                {{ $review->comment }}
            </td>


           <!-- AKSI -->
@if(auth()->user()->role === 'admin' || auth()->id() === $review->user_id)
<td class="px-6 py-4 text-center">

    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button
        type="submit"
        class="btn-hapus inline-flex items-center gap-2
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

</td>
@endif

            

        </tr>

        @empty

        <tr>
            <td colspan="6" class="p-8 text-center text-gray-500">
                @if(request('search'))
                    Data tidak ditemukan
                @else
                    Belum ada ulasan
                @endif
            </td>
        </tr>

        @endforelse

        </tbody>
    </table>

</div>


<!-- PAGINATION -->
<div class="mt-6">
    {{ $reviews->links() }}
</div>


<!-- BUTTON KEMBALI -->
<div class="mt-12">

    @if(auth()->user()->role === 'admin')
    <a href="{{ route('dashboard.admin') }}"
       class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 
       px-5 py-2.5 rounded-xl hover:bg-gray-300 transition font-medium shadow-sm">
        ← Kembali
    </a>
    @else
    <a href="{{ route('dashboard.user') }}"
       class="inline-flex items-center gap-2 bg-gray-200 text-gray-700 
       px-5 py-2.5 rounded-xl hover:bg-gray-300 transition font-medium shadow-sm">
        ← Kembali
    </a>
    @endif

</div>

</div>

@endsection
