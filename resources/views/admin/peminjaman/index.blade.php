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
            </div>

            @if(auth()->user()->role == 'user')
            <a href="{{ route('peminjaman.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-lg shadow-md transition font-semibold">
                + Pinjam Buku
            </a>
            @endif
        </div>

        {{-- SEARCH --}}
        <div class="mb-6">
            <form method="GET" action="{{ route(Route::currentRouteName()) }}" class="flex gap-3">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari user atau judul buku..."
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

                  {{-- BUTTON REFRESH (RESET) --}}
        @if(request('search'))
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

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">User</th>
                        <th class="px-6 py-4 text-left">Buku</th>
                        <th class="px-6 py-4 text-left">Tgl Pinjam</th>
                        <th class="px-6 py-4 text-left">Tgl Kembali</th>
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
    <td class="px-6 py-4">{{ $d->tanggal_pengembalian ?? '-' }}</td>

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
                    Menunggu Pengembalian
                </span>
            @break

            @case('Dikembalikan')
                <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold">
                    Selesai
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
    <div class="flex justify-center gap-2 flex-wrap">

    {{-- ADMIN / PETUGAS --}}
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')

        {{-- APPROVE / REJECT PEMINJAMAN --}}
        @if($d->status_peminjaman == 'Menunggu')

            <form id="approve-{{ $d->id }}" method="POST"
                  action="{{ route('peminjaman.setujui', $d->id) }}">
                @csrf
                <button type="button"
                    onclick="approve({{ $d->id }})"
                    class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700
                    text-white px-3 py-2 rounded-lg text-xs font-medium
                    shadow-sm hover:shadow-md transition-all">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4" />
                        <circle cx="12" cy="12" r="9" />
                    </svg>

                    Setujui
                </button>
            </form>

            <form id="reject-{{ $d->id }}" method="POST"
                  action="{{ route('peminjaman.tolak', $d->id) }}">
                @csrf
                <button type="button"
                    onclick="reject({{ $d->id }})"
                    class="inline-flex items-center gap-1 bg-rose-600 hover:bg-rose-700
                    text-white px-3 py-2 rounded-lg text-xs font-medium
                    shadow-sm hover:shadow-md transition-all">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 9l-6 6M9 9l6 6" />
                        <circle cx="12" cy="12" r="9" />
                    </svg>

                    Tolak
                </button>
            </form>

        @endif


        {{-- APPROVE / REJECT PENGEMBALIAN --}}
        @if($d->status_peminjaman == 'Menunggu Pengembalian')

            <form id="approveReturn-{{ $d->id }}" method="POST"
                  action="{{ route('pengembalian.setujui', $d->id) }}">
                @csrf
                <button type="button"
                    onclick="approveReturn({{ $d->id }})"
                    class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700
                    text-white px-3 py-2 rounded-lg text-xs font-medium
                    shadow-sm hover:shadow-md transition-all">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4" />
                        <circle cx="12" cy="12" r="9" />
                    </svg>

                    Setujui
                </button>
            </form>

            <form id="rejectReturn-{{ $d->id }}" method="POST"
                  action="{{ route('pengembalian.tolak', $d->id) }}">
                @csrf
                <button type="button"
                    onclick="rejectReturn({{ $d->id }})"
                    class="inline-flex items-center gap-1 bg-rose-600 hover:bg-rose-700
                    text-white px-3 py-2 rounded-lg text-xs font-medium
                    shadow-sm hover:shadow-md transition-all">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 9l-6 6M9 9l6 6" />
                        <circle cx="12" cy="12" r="9" />
                    </svg>

                    Tolak
                </button>
            </form>

        @endif

    @endif


    {{-- BADGE SELESAI --}}
    @if($d->status_peminjaman == 'Dikembalikan')
        <span class="bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-semibold">
            Selesai
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
</div>

{{-- SWEETALERT --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function approve(id){
    Swal.fire({
        title:'Setujui Peminjaman?',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'Ya'
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById('approve-'+id).submit();
        }
    })
}

function reject(id){
    Swal.fire({
        title:'Tolak Peminjaman?',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Ya'
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById('reject-'+id).submit();
        }
    })
}

function ajukanReturn(id){
    Swal.fire({
        title:'Ajukan Pengembalian?',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'Ya'
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById('return-'+id).submit();
        }
    })
}

function approveReturn(id){
    Swal.fire({
        title:'Setujui Pengembalian?',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'Ya'
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById('approveReturn-'+id).submit();
        }
    })
}

function rejectReturn(id){
    Swal.fire({
        title:'Tolak Pengembalian?',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Ya'
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById('rejectReturn-'+id).submit();
        }
    })
}
</script>
@endpush

@endsection