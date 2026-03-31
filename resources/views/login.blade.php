<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { backdrop-filter: blur(14px); background: rgba(255,255,255,0.75); }
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 flex items-center justify-center px-4">

<div class="w-full max-w-md glass rounded-3xl shadow-2xl p-10">

    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Selamat Datang Kembali</h1>
        <p class="text-slate-600">Masuk untuk melanjutkan membaca</p>
    </div>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="mb-4 p-4 rounded-xl bg-red-100 text-red-700 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.process') }}" class="space-y-5">
        @csrf

        <!-- EMAIL -->
        <div>
            <label class="text-sm font-medium text-slate-700">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   class="w-full mt-1 px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                   placeholder="email@example.com">
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="text-sm font-medium text-slate-700">Password</label>
            <input type="password"
                   name="password"
                   required
                   class="w-full mt-1 px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                   placeholder="••••••••">
        </div>

        <!-- BUTTON -->
        <button type="submit"
                class="w-full btn-primary text-white py-3 rounded-2xl font-semibold shadow-lg hover:scale-105 transition">
            Masuk
        </button>
    </form>

    <p class="text-center text-sm text-slate-600 mt-8">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:underline">Daftar sekarang</a>
    </p>

</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
