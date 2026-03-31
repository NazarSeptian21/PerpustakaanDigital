<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8">

    <!-- HEADER -->
    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Kategori
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Buat kategori baru untuk mengelompokkan buku
        </p>
    </div>

    <!-- FORM -->
    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Nama Kategori
            </label>

            <input type="text"
                   name="nama"
                   placeholder="Contoh: Novel"
                   class="w-full border border-gray-300 rounded-lg px-4 py-3
                          focus:outline-none focus:ring-2 focus:ring-blue-500
                          focus:border-blue-500 transition shadow-sm">
        </div>

        <!-- BUTTON AREA -->
        <div class="flex items-center justify-between pt-4">
            <a href="{{ route('kategori.index') }}"
               class="text-gray-600 hover:text-gray-800 transition text-sm">
                ← Kembali
            </a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700
                           text-white font-medium px-6 py-2.5
                           rounded-lg shadow-md transition">
                Simpan
            </button>
        </div>

    </form>

</div>

</body>
</html>
