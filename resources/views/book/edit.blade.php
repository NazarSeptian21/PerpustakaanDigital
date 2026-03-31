<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8 text-gray-800">
        Edit Buku
    </h1>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
        <ul class="list-disc ml-6">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white p-8 rounded-2xl shadow border">

        <form action="{{ route('admin.books.update', $book->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="space-y-6">
            @csrf
            @method('PUT')

            <!-- JUDUL -->
            <div>
                <label class="block mb-2 font-semibold">Judul Buku</label>
                <input type="text" 
                       name="judul"
                       value="{{ old('judul', $book->judul) }}"
                       class="w-full border px-4 py-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
                       required>
            </div>

            <!-- PENULIS -->
            <div>
                <label class="block mb-2 font-semibold">Penulis</label>
                <input type="text" 
                       name="penulis"
                       value="{{ old('penulis', $book->penulis) }}"
                       class="w-full border px-4 py-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
                       required>
            </div>

            <!-- STOK -->
            <div>
                <label class="block mb-2 font-semibold">Stok Buku</label>

                <div class="flex items-center gap-4">
                    <input type="number" 
                           name="stok"
                           min="0"
                           value="{{ old('stok', $book->stok) }}"
                           class="w-full border px-4 py-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
                           required>

                    {{-- Badge Status --}}
                    @if($book->stok > 0)
                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-lg text-sm font-semibold">
                            Tersedia
                        </span>
                    @else
                        <span class="bg-red-100 text-red-700 px-4 py-2 rounded-lg text-sm font-semibold">
                            Stok Habis
                        </span>
                    @endif
                </div>
            </div>

            <!-- KATEGORI -->
            <div>
                <label class="block mb-2 font-semibold">Kategori</label>
                <select name="kategori_id"
                        class="w-full border px-4 py-3 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none"
                        required>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ $book->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

             {{-- ISBN --}}
<div class="mb-4">
    <label class="block text-sm font-semibold mb-2">ISBN</label>
    <input type="text"
           name="isbn"
           value="{{ old('isbn',$book->isbn) }}"
           class="w-full px-4 py-2 rounded-xl border focus:ring-2 focus:ring-indigo-500"
           placeholder="Masukkan ISBN buku">
</div>

{{-- Penerbit --}}
<div class="mb-4">
    <label class="block text-sm font-semibold mb-2">Penerbit</label>
    <input type="text"
           name="penerbit"
           value="{{ old('penerbit', $book->penerbit) }}"
           class="w-full px-4 py-2 rounded-xl border focus:ring-2 focus:ring-indigo-500"
           placeholder="Masukkan nama penerbit">
</div>

{{-- Tahun Terbit --}}
<div class="mb-4">
    <label class="block text-sm font-semibold mb-2">Tahun Terbit</label>
    <input type="number"
           name="tahun_terbit"
           value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
           class="w-full px-4 py-2 rounded-xl border focus:ring-2 focus:ring-indigo-500"
           placeholder="Contoh: 2024">
</div>

            <!-- COVER LAMA -->
            @if($book->cover)
            <div>
                <label class="block mb-2 font-semibold">Cover Saat Ini</label>
                <img src="{{ asset('covers/' . $book->cover) }}"
                     class="w-32 rounded shadow">
            </div>
            @endif

            <!-- COVER BARU -->
            <div>
                <label class="block mb-2 font-semibold">Ganti Cover (Opsional)</label>
                <input type="file" 
                       name="cover"
                       class="w-full border px-4 py-3 rounded-xl">
            </div>

            <!-- BUTTON -->
            <div class="flex gap-4 pt-4">
                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-3 rounded-xl shadow hover:bg-indigo-700 transition">
                    Update Buku
                </button>

                <a href="{{ route('books.index') }}"
                   class="bg-gray-200 px-6 py-3 rounded-xl hover:bg-gray-300 transition">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>