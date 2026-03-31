<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>About | Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass { backdrop-filter: blur(14px); background: rgba(255,255,255,0.75); }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 min-h-screen">

<section class="pt-40 pb-32">
    <div class="max-w-5xl mx-auto px-8">
        <div class="glass rounded-[2rem] shadow-2xl p-12">
            <span class="inline-flex items-center gap-2 mb-6 px-5 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold">
                <i data-lucide="info"></i>
                Tentang Kami
            </span>

            <h1 class="text-4xl font-extrabold text-slate-900 mb-6">
                Membangun Budaya Membaca Digital
            </h1>

            <p class="text-slate-600 leading-relaxed text-lg mb-6">
                <strong>Perpustakaan Digital</strong> hadir sebagai solusi modern untuk
                mengakses ilmu pengetahuan tanpa batas ruang dan waktu.
            </p>

            <p class="text-slate-600 leading-relaxed text-lg mb-6">
                Kami percaya bahwa membaca adalah fondasi peradaban.
                Dengan teknologi, kami menghadirkan pengalaman membaca yang
                nyaman, aman, dan elegan.
            </p>

            <div class="grid md:grid-cols-3 gap-8 mt-12">
                <div>
                    <i data-lucide="book-open" class="w-8 h-8 text-indigo-600 mb-3"></i>
                    <h3 class="font-semibold text-lg mb-2">Ilmu Berkualitas</h3>
                    <p class="text-slate-600">Koleksi buku terkurasi dan terpercaya.</p>
                </div>
                <div>
                    <i data-lucide="sparkles" class="w-8 h-8 text-indigo-600 mb-3"></i>
                    <h3 class="font-semibold text-lg mb-2">Desain Elegan</h3>
                    <p class="text-slate-600">Antarmuka modern dan nyaman.</p>
                </div>
                <div>
                    <i data-lucide="shield-check" class="w-8 h-8 text-indigo-600 mb-3"></i>
                    <h3 class="font-semibold text-lg mb-2">Aman & Privat</h3>
                    <p class="text-slate-600">Keamanan data pengguna terjamin.</p>
                </div>
            </div>

            <div class="mt-12">
                <a href="/" class="text-indigo-600 font-semibold hover:underline">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    lucide.createIcons();
</script>
</body>
</html>
