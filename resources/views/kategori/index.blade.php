@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Data Kategori
            </h1>
            <p class="text-slate-500 text-sm mt-1">
                Kelola seluruh kategori buku
            </p>
            <div class="w-16 h-1 bg-indigo-600 rounded mt-3"></div>
        </div>

        <a href="{{ route('kategori.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-xl shadow hover:bg-indigo-700 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Tambah Kategori
        </a>
    </div>

    <!-- SEARCH -->
    <div class="mb-6">
        <form method="GET" action="{{ route('kategori.index') }}" class="flex gap-3 items-center">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari kategori..."
                   class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">

            <button type="submit"
                    class="flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition font-semibold shadow-md">

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
               class="group flex items-center justify-center w-11 h-11 bg-gray-100 hover:bg-indigo-50 rounded-xl transition-all duration-300 shadow-sm hover:shadow-md"
               title="Reset Pencarian">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-gray-600 group-hover:text-indigo-600 group-hover:rotate-180 transition-all duration-500"
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
    </div>

    <!-- TABLE -->
    <div class="bg-white shadow-sm border rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">

            <table class="min-w-full text-sm text-slate-600">

                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Nama Kategori</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($kategori as $k)
                    <tr class="hover:bg-slate-50 transition">

                        <td class="px-6 py-4 font-medium text-slate-700">
                            {{ ($kategori->currentPage() - 1) * $kategori->perPage() + $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 font-medium text-slate-800">
                            {{ $k->nama }}
                        </td>

                        <!-- AKSI -->
                        <td class="px-6 py-4 text-center">

                            <div class="flex justify-center items-center gap-6">

                                <!-- EDIT -->
                                <a href="{{ route('kategori.edit', $k->id) }}"
                                   class="flex items-center gap-1 text-amber-600 hover:text-amber-700 font-medium transition"
                                   title="Edit">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-4 h-4"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor"
                                         stroke-width="2">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M11 5h2m-1-1v2m-6 6l8-8 4 4-8 8H6v-4z"/>
                                    </svg>

                                    Edit
                                </a>

                                <!-- DELETE -->
                                  <form action="{{ route('kategori.destroy', $k->id) }}" method="POST">
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

                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-slate-400">
                            Data tidak ditemukan
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $kategori->withQueryString()->links() }}
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