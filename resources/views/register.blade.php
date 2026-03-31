<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gradient-to-br from-indigo-200 via-purple-100 to-pink-100 min-h-screen flex items-center justify-center">

<div class="backdrop-blur-lg bg-white/80 border border-white/40 p-10 rounded-3xl shadow-2xl w-full max-w-md">

    <!-- LOGO -->
    <div class="text-center mb-8">
        <div class="w-16 h-16 mx-auto mb-3 bg-indigo-600 text-white flex items-center justify-center rounded-2xl shadow-lg text-2xl font-bold">
            📚
        </div>

        <h2 class="text-2xl font-bold text-indigo-700">
            Daftar Akun
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Buat akun baru untuk mengakses perpustakaan
        </p>
    </div>


    <!-- ERROR VALIDASI -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl mb-5">
            <strong class="block mb-1">Terjadi kesalahan:</strong>
            <ul class="list-disc ml-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- FORM REGISTER -->
    <form method="POST" action="{{ route('register.store') }}" class="space-y-5">

        @csrf

        <!-- NAMA -->
        <div>
            <label class="block text-sm font-semibold mb-1 text-gray-700">
                Nama
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                placeholder="Masukkan nama lengkap"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition"
            >
        </div>


        <!-- EMAIL -->
        <div>
            <label class="block text-sm font-semibold mb-1 text-gray-700">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                placeholder="Masukkan email"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition"
            >
        </div>


        <!-- PASSWORD -->
        <div>
            <label class="block text-sm font-semibold mb-1 text-gray-700">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                placeholder="Minimal 6 karakter"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition"
            >
        </div>


        <!-- KONFIRMASI PASSWORD -->
        <div>
            <label class="block text-sm font-semibold mb-1 text-gray-700">
                Konfirmasi Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                required
                placeholder="Ulangi password"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition"
            >
        </div>


        <!-- BUTTON -->
        <button
            type="submit"
            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold shadow-md transition duration-200"
        >
            Buat Akun
        </button>

    </form>


    <!-- LINK LOGIN -->
    <p class="text-sm text-center mt-8 text-gray-600">
        Sudah punya akun?
        <a href="{{ route('login') }}"
           class="text-indigo-600 font-semibold hover:underline">
            Login disini
        </a>
    </p>

</div>

</body>
</html>
