@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">
            Riwayat Peminjaman
        </h1>
        <p class="text-slate-500 text-sm mt-1">
            Daftar seluruh aktivitas peminjaman buku
        </p>
        <div class="w-16 h-1 bg-indigo-600 rounded mt-3"></div>
    </div>

    <!-- Search -->
    <div class="mb-6">
        <form method="GET" action="{{ route(Route::currentRouteName()) }}" class="flex items-center gap-3">
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

    <!-- Card -->
    <div class="bg-white shadow-sm border rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Buku</th>
                        <th class="px-6 py-4">Tanggal Pinjam</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($data as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $item->user->name }}
                            </td>

                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $item->book->judul }}
                            </td>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                @if($item->status_peminjaman == 'Dipinjam')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                        Dipinjam
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                        Dikembalikan
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-400">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $data->withQueryString()->links() }}
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