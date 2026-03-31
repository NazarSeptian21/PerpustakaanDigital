@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-800">
            Data Pengguna
        </h1>
        <p class="text-slate-500 text-sm mt-1">
            Daftar semua akun pengguna yang terdaftar dalam sistem
        </p>
        <div class="w-16 h-1 bg-indigo-600 rounded mt-3"></div>
    </div>


    {{-- 🔍 SEARCH --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('users.index') }}">
            <div class="flex gap-3 items-center">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari berdasarkan nama atau email..."
                       class="w-full md:w-1/3 border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none px-4 py-2 rounded-lg shadow-sm">

                <!-- Button Cari -->
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

                @if(request('search'))
                <!-- Reset Icon -->
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

            </div>
        </form>
    </div>


    {{-- TABLE CARD --}}
    <div class="bg-white shadow-sm border rounded-2xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full text-sm text-left text-slate-600">

                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-6 py-4 w-16">No</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($users as $index => $user)

                    <tr class="hover:bg-slate-50 transition">

                        <td class="px-6 py-4 font-medium text-slate-700">
                            {{ $users->firstItem() + $index }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-500 text-white flex items-center justify-center rounded-full font-bold shadow">
                                    {{ strtoupper(substr($user->name,0,1)) }}
                                </div>
                                <span class="font-medium text-slate-800">
                                    {{ $user->name }}
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                       <td class="px-6 py-4 text-center">

<form action="{{ route('users.destroy', $user->id) }}" method="POST">
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

</td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400">
                            Tidak ada data pengguna
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- PAGINATION (kalau pakai paginate) --}}
    @if(method_exists($users, 'links'))
    <div class="mt-6">
        {{ $users->withQueryString()->links() }}
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