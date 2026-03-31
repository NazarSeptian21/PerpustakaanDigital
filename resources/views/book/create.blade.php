@extends('layouts.app')

@section('content')
<div class="p-8 max-w-2xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">Tambah Buku</h1>

    {{-- ALERT ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4 bg-white p-6 rounded-xl shadow">
        @csrf

        {{-- JUDUL --}}
        <div>
            <label class="block mb-1 font-medium">Judul Buku</label>
            <input type="text" name="judul"
                   value="{{ old('judul') }}"
                   class="w-full border p-3 rounded-lg focus:ring focus:ring-indigo-200">
        </div>

        {{-- PENULIS --}}
        <div>
            <label class="block mb-1 font-medium">Penulis</label>
            <input type="text" name="penulis"
                   value="{{ old('penulis') }}"
                   class="w-full border p-3 rounded-lg focus:ring focus:ring-indigo-200">
        </div>

        {{-- ISBN --}}
<div class="mb-4">
    <label class="block text-sm font-semibold mb-2">ISBN</label>
    <input type="text"
           name="isbn"
           value="{{ old('isbn') }}"
           class="w-full px-4 py-2 rounded-xl border focus:ring-2 focus:ring-indigo-500"
           placeholder="Masukkan ISBN buku">
</div>

{{-- Penerbit --}}
<div class="mb-4">
    <label class="block text-sm font-semibold mb-2">Penerbit</label>
    <input type="text"
           name="penerbit"
           value="{{ old('penerbit') }}"
           class="w-full px-4 py-2 rounded-xl border focus:ring-2 focus:ring-indigo-500"
           placeholder="Masukkan nama penerbit">
</div>

{{-- Tahun Terbit --}}
<div class="mb-4">
    <label class="block text-sm font-semibold mb-2">Tahun Terbit</label>
    <input type="number"
           name="tahun_terbit"
           value="{{ old('tahun_terbit') }}"
           class="w-full px-4 py-2 rounded-xl border focus:ring-2 focus:ring-indigo-500"
           placeholder="Contoh: 2024">
</div>

{{-- Stok Buku --}}
<div class="mb-4">
    <label class="block text-sm font-semibold mb-2">Stok Buku</label>
    <input type="number"
           name="stok"
           value="{{ old('stok') }}"
           min="0"
           class="w-full px-4 py-2 rounded-xl border focus:ring-2 focus:ring-indigo-500"
           placeholder="Masukkan jumlah stok">
</div>

        {{-- KATEGORI --}}
        <div>
            <label class="block mb-1 font-medium">Kategori</label>
            <select name="kategori_id"
                    class="w-full border p-3 rounded-lg focus:ring focus:ring-indigo-200">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $k)
                    <option value="{{ $k->id }}"
                        {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
        </div>

    

        {{-- COVER --}}
        <div>
            <label class="block mb-1 font-medium">Cover Buku</label>
            <input type="file" name="cover"
                   class="w-full border p-3 rounded-lg">
        </div>

        {{-- BUTTON --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('books.index') }}"
               class="bg-gray-500 text-white px-5 py-3 rounded-lg hover:bg-gray-600">
               Kembali
            </a>

            <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                Simpan Buku
            </button>
        </div>

    </form>
</div>
@endsection
