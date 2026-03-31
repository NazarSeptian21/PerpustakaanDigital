<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .card {
            transition: all .25s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0,0,0,.12);
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-64 bg-white shadow-xl fixed inset-y-0">
    <div class="p-6 border-b">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                <i data-lucide="book-open"></i>
            </div>
            <span class="font-extrabold text-indigo-700 text-lg">
                Perpus Digital
            </span>
        </div>
    </div>

    <nav class="p-6 space-y-4 text-slate-600 font-medium">
        <a href="#" class="flex items-center gap-3 text-indigo-600 font-semibold">
            <i data-lucide="layout-dashboard"></i> Dashboard
        </a>
        <a href="#" class="flex items-center gap-3 hover:text-indigo-600">
            <i data-lucide="book"></i> Data Buku
        </a>
        <a href="#" class="flex items-center gap-3 hover:text-indigo-600">
            <i data-lucide="users"></i> Anggota
        </a>
        <a href="#" class="flex items-center gap-3 hover:text-indigo-600">
            <i data-lucide="repeat"></i> Peminjaman
        </a>
        <a href="#" class="flex items-center gap-3 hover:text-indigo-600">
            <i data-lucide="bar-chart"></i> Laporan
        </a>
    </nav>
</aside>

<!-- MAIN -->
<main class="flex-1 ml-64 p-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-extrabold text-slate-800">
            Dashboard
        </h1>

        <div class="flex items-center gap-4">
            <span class="text-slate-600">Admin</span>
            <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                A
            </div>
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="grid md:grid-cols-3 gap-6 mb-12">
        <div class="card bg-white p-6 rounded-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">Total Buku</p>
                    <h2 class="text-3xl font-bold">1.250</h2>
                </div>
                <i data-lucide="book" class="w-8 h-8 text-indigo-600"></i>
            </div>
        </div>

        <div class="card bg-white p-6 rounded-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">Anggota</p>
                    <h2 class="text-3xl font-bold">320</h2>
                </div>
                <i data-lucide="users" class="w-8 h-8 text-emerald-600"></i>
            </div>
        </div>

        <div class="card bg-white p-6 rounded-2xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-500 text-sm">Dipinjam</p>
                    <h2 class="text-3xl font-bold">87</h2>
                </div>
                <i data-lucide="repeat" class="w-8 h-8 text-orange-500"></i>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 border-b">
            <h3 class="font-bold text-lg text-slate-800">
                Buku Terbaru
            </h3>
        </div>

        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-600 text-sm">
                <tr>
                    <th class="px-6 py-4">Judul</th>
                    <th class="px-6 py-4">Penulis</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium">Kekuatan Doa</td>
                    <td class="px-6 py-4">Anggita</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-sm rounded-full bg-emerald-100 text-emerald-600">
                            Tersedia
                        </span>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium">Garis Nadir</td>
                    <td class="px-6 py-4">Anggita</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-sm rounded-full bg-orange-100 text-orange-600">
                            Dipinjam
                        </span>
                    </td>
                </tr>
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4 font-medium">Lentera Jiwa</td>
                    <td class="px-6 py-4">Anggita</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-sm rounded-full bg-emerald-100 text-emerald-600">
                            Tersedia
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</main>

<script>
    lucide.createIcons();
</script>

</body>
</html>
