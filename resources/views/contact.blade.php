<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Contact | Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass {
            backdrop-filter: blur(16px);
            background: rgba(255,255,255,0.75);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-indigo-50 to-purple-50 min-h-screen">

<section class="pt-36 pb-28">
    <div class="max-w-5xl mx-auto px-6">

        <!-- HEADER -->
        <div class="text-center mb-20">
            <span class="inline-flex items-center gap-2 mb-5 px-5 py-2 rounded-full bg-indigo-100 text-indigo-700 text-sm font-semibold">
                <i data-lucide="headphones"></i>
                Hubungi Kami
            </span>

            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900">
                Ada Pertanyaan? <span class="text-indigo-600">Kami Siap Membantu</span>
            </h1>

            <p class="mt-5 text-slate-600 text-lg max-w-2xl mx-auto">
                Silakan hubungi tim Perpustakaan Digital melalui saluran di bawah ini.
                Kami akan merespons secepat mungkin.
            </p>
        </div>

        <!-- INFO KONTAK -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- WHATSAPP -->
            <div class="glass rounded-2xl shadow-xl p-10 text-center hover:-translate-y-1 transition">
                <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-green-100 text-green-600 mx-auto mb-6">
                    <i data-lucide="phone" class="w-7 h-7"></i>
                </div>

                <h3 class="text-lg font-bold text-slate-900 mb-2">
                    WhatsApp
                </h3>

                <p class="text-slate-600 mb-4">
                    Hubungi kami melalui WhatsApp
                </p>

                <a href="https://wa.me/6281234567890"
                   target="_blank"
                   class="text-green-600 font-semibold hover:underline">
                    +62 895-3438-71070
                </a>
            </div>

            <!-- EMAIL -->
            <div class="glass rounded-2xl shadow-xl p-10 text-center hover:-translate-y-1 transition">
                <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-yellow-100 text-yellow-600 mx-auto mb-6">
                    <i data-lucide="mail" class="w-7 h-7"></i>
                </div>

                <h3 class="text-lg font-bold text-slate-900 mb-2">
                    Email Resmi
                </h3>

                <p class="text-slate-600 mb-4">
                    Kirim pertanyaan atau kerja sama
                </p>

                <a href="mailto:info@perpustakaan.id"
                   class="text-indigo-600 font-semibold hover:underline">
                    infoperpustakaan.dig@gmail.com
                </a>
            </div>

        </div>

        <!-- BACK -->
        <div class="mt-16 text-center">
            <a href="/" class="text-indigo-600 font-semibold hover:underline">
                ← Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

<script>
    lucide.createIcons();
</script>

</body>
</html>
